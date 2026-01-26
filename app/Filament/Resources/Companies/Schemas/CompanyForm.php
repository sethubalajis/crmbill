<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
			
			
			
               TextInput::make('name')
            ->required(),

        TextInput::make('address')
            ->required(),

        TextInput::make('phone')
            ->required(),

        TextInput::make('state')
            ->required(),

        TextInput::make('gstinno'),

        TextInput::make('phone2'),

        TextInput::make('email')
            ->required(),

        TextInput::make('pan')
            ->required(),

        TextInput::make('country')
            ->required(),

        TextInput::make('postalcode')
            ->required(),

        TextInput::make('bankname')
            ->required(),

        TextInput::make('accountno')
            ->required(),

        TextInput::make('ifsc')
            ->required(),

        TextInput::make('accountname')
            ->required(),

        FileUpload::make('logo'),
					
					
					
            ]);
    }
}
