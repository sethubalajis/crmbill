<?php

namespace App\Filament\Resources\Invoices\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoiceitemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'item_id';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('item_id')
                    ->relationship('item', 'name')
                    ->required()
                    ->label('Item'),
                TextInput::make('quantity')
                    ->numeric()
                    ->default(1)
                    ->required(),
                Select::make('gst_id')
                    ->relationship('gst', 'percentage')
                    ->required()
                    ->label('GST'),
                TextInput::make('item_rate')
                    ->numeric()
                    ->label('Item Rate'),
                TextInput::make('item_gst')
                    ->numeric()
                    ->label('Item GST'),
                TextInput::make('total')
                    ->numeric()
                    ->step(0.01)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item.name')
                    ->label('Item'),
                TextColumn::make('quantity'),
                TextColumn::make('gst.percentage')
                    ->label('GST %'),
                TextColumn::make('item_rate')
                    ->label('Item Rate'),
                TextColumn::make('item_gst')
                    ->label('Item GST'),
                TextColumn::make('total'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Item'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
