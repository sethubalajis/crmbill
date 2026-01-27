<?php

namespace App\Filament\Resources\Customers\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AddressesRelationManager extends RelationManager
{
    protected static string $relationship = 'addresses';

    protected static ?string $recordTitleAttribute = 'street_address';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('address_type')
                    ->options([
                        'Billing' => 'Billing',
                        'Shipping' => 'Shipping',
                    ])
                    ->required(),
                Textarea::make('street_address')
                    ->required()
                    ->rows(2),
                TextInput::make('city'),
                TextInput::make('state'),
                TextInput::make('pincode'),
                Toggle::make('is_default')
                    ->label('Default'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('address_type'),
                TextColumn::make('street_address'),
                TextColumn::make('city'),
                TextColumn::make('state'),
                TextColumn::make('pincode'),
                TextColumn::make('is_default')
                    ->label('Default')
                    ->boolean(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
