<?php

namespace App\Filament\Resources\Gsts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GstForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('percentage')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
