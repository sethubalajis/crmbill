<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->default(null),
                TextInput::make('address')
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                TextInput::make('phone2')
                    ->tel()
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                Select::make('country_id')
                    ->relationship('country', 'name')
                    ->default(null),
                Select::make('state_id')
                    ->relationship('state', 'name')
                    ->default(null),
                Select::make('city_id')
                    ->relationship('city', 'name')
                    ->default(null),
                TextInput::make('postalcode')
                    ->default(null),
                TextInput::make('gstinno')
                    ->label('GSTIN No')
                    ->maxLength(10)
                    ->default(null),
                TextInput::make('pan')
                    ->default(null),
                TextInput::make('bankname')
                    ->default(null),
                TextInput::make('accountno')
                    ->default(null),
                TextInput::make('ifsc')
                    ->default(null),
                TextInput::make('accountname')
                    ->default(null),
                FileUpload::make('logo')
                    ->image()
                    ->disk('public')
                    ->directory('companies')
                    ->visibility('public')
                    ->imagePreviewHeight('150')
                    ->default(null),
            ]);
    }
}
