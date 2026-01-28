<?php

namespace App\Filament\Resources\Quotations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuotationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('quotationno')
                    ->label('Quotation No')
                    ->disabled()
                    ->dehydrated(false)
                    ->placeholder('Auto-generated')
                    ->id('quotationno'),
                DatePicker::make('date')
                    ->default(today()),
                Select::make('customer_id')
                    ->relationship('customer', 'company_name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->company_name} | {$record->contact_person} | {$record->phone1}")
                    ->searchable()
                    ->required(),
                Toggle::make('intrastate')
                    ->label('Intra State')
                    ->inline(),
                TextInput::make('total')
                    ->disabled()
                    ->dehydrated(false)
                    ->numeric()
                    ->default(null)
                    ->id('total')
                    ->live(),

 

                TextInput::make('gststate')
                    ->label('GST State')
                    ->disabled()
                    ->dehydrated(false)
                    ->numeric()
                    ->default(null)
                    ->id('gststate'),
            ]);
    }
}
