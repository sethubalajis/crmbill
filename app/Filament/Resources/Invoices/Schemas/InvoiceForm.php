<?php

namespace App\Filament\Resources\Invoices\Schemas;

use App\Models\Invoice;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('invoiceno')
                    ->label('Invoice Number')
                    ->disabled()
                    ->dehydrated(false)
                    ->placeholder('Auto-generated')
                    ->maxLength(30),
                DatePicker::make('invoicedate')
                    ->label('Invoice Date')
                    ->default(today())
                    ->required(),
                Select::make('customer_id')
                    ->label('Customer')
                    ->relationship('customer', 'company_name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->company_name} | {$record->contact_person} | {$record->phone1}")
                    ->searchable()
                    ->required(),
                TextInput::make('total')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                TextInput::make('cgst')
                    ->label('CGST')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                TextInput::make('sgst')
                    ->label('SGST')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                Toggle::make('intrastate')
                    ->label('Intrastate Transaction')
                    ->default(false),
            ]);
    }
}
