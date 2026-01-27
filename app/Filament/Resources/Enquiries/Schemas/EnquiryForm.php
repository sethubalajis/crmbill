<?php

namespace App\Filament\Resources\Enquiries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class EnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date'),
                TextInput::make('company')
                    ->default(null),
                TextInput::make('name')
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                TextInput::make('description')
                    ->default(null),
                DatePicker::make('callbackdate'),
                TimePicker::make('callbacktime'),
            ]);
    }
}
