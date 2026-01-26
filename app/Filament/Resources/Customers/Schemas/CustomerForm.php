<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
	use Filament\Forms\Components\Select;  
class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
             
					
				      TextInput::make('companyname')
            ->required(),

        TextInput::make('contactname')
            ->required(),

        TextInput::make('email'),

        TextInput::make('address')
            ->required(),

        TextInput::make('designation'),

        TextInput::make('gst'),

        TextInput::make('pan')
            ->required(),

        Select::make('state_id')  
     ->relationship('state', 'name')
            ->required(),

        Select::make('country_id')  
     ->relationship('country', 'name')
            ->required(),

        TextInput::make('postalcode')
            ->required(),
					
					
            ]);
    }
}
