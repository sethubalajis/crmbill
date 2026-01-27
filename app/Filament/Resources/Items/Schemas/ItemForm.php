<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->default(null),
                TextInput::make('name')
                    ->default(null),
                TextInput::make('description')
                    ->default(null),
                TextInput::make('rate')
                    ->numeric()
                    ->default(null),
                TextInput::make('hsn')
                    ->default(null),
            ]);
    }
}
