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
                    ->default(null),
                DatePicker::make('date'),
                Select::make('customer_id')
                    ->relationship('customer', 'id')
                    ->default(null),
                TextInput::make('total')
                    ->numeric()
                    ->default(null),
                TextInput::make('gstcentral')
                    ->numeric()
                    ->default(null),
                Toggle::make('intrastate'),
                TextInput::make('gststate')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
