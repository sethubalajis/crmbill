<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_name')
                    ->required(),
                TextInput::make('contact_person')
                    ->default(null),
                TextInput::make('designation')
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                TextInput::make('phone1')
                    ->tel()
                    ->default(null),
                TextInput::make('phone2')
                    ->tel()
                    ->default(null),
                TextInput::make('gst_number')
                    ->default(null),
                TextInput::make('pan_number')
                    ->default(null),
            ]);
    }
}
