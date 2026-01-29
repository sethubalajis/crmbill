<?php

namespace App\Filament\Resources\Quotations\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\Summarizers\Sum;

class QuotationitemsRelationManager extends RelationManager
{
    protected static string $relationship = 'quotationitems';

    protected static ?string $recordTitleAttribute = 'item_id';

    protected string $view = 'filament.resources.quotation-items-relation-manager';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('item_id')
                ->relationship('item', 'name')
                ->required()
                ->label('Item')
                ->live()
                ->afterStateUpdated(function ($state, $get, $set) {
                    if (!$state) {
                        return;
                    }

                    $item = \App\Models\Item::find($state);
                    if (!$item) {
                        return;
                    }

                    $set('item_rate', $item->rate);

                    $gstId = $get('gst_id');
                    $quantity = $get('quantity');
                    if (!$gstId || !$quantity) {
                        return;
                    }

                    $gst = \App\Models\Gst::find($gstId);
                    if (!$gst) {
                        return;
                    }

                    $itemGst = round(($item->rate * $gst->percentage / 100) * $quantity, 2);
                    $set('item_gst', $itemGst);
                    $total = round(($item->rate * $quantity) + $itemGst, 2);
                    $set('total', $total);
                }),
            TextInput::make('quantity')
                ->numeric()
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, $get, $set) {
                    $itemRate = $get('item_rate');
                    $gstId = $get('gst_id');
                    if (!$state || !$itemRate || !$gstId) {
                        return;
                    }

                    $gst = \App\Models\Gst::find($gstId);
                    if (!$gst) {
                        return;
                    }

                    $itemGst = round(($itemRate * $gst->percentage / 100) * $state, 2);
                    $set('item_gst', $itemGst);
                    $total = round(($itemRate * $state) + $itemGst, 2);
                    $set('total', $total);
                }),
            Select::make('gst_id')
                ->relationship('gst', 'percentage')
                ->required()
                ->label('GST')
                ->live()
                ->afterStateUpdated(function ($state, $get, $set) {
                    $itemRate = $get('item_rate');
                    $quantity = $get('quantity');
                    if (!$state || !$itemRate) {
                        return;
                    }

                    $gst = \App\Models\Gst::find($state);
                    if (!$gst) {
                        return;
                    }

                    $itemGst = round(($itemRate * $gst->percentage / 100) * $quantity, 2);
                    $set('item_gst', $itemGst);
                    $total = round(($itemRate * $quantity) + $itemGst, 2);
                    $set('total', $total);
                }),
            TextInput::make('item_rate')
                ->numeric()
                ->label('Item Rate In Rs.')
                ->live()
                ->afterStateUpdated(function ($state, $get, $set) {
                    $gstId = $get('gst_id');
                    $quantity = $get('quantity');
                    if (!$state || !$gstId) {
                        return;
                    }

                    $gst = \App\Models\Gst::find($gstId);
                    if (!$gst) {
                        return;
                    }

                    $itemGst = round(($state * $gst->percentage / 100) * $quantity, 2);
                    $set('item_gst', $itemGst);
                    $total = round(($state * $quantity) + $itemGst, 2);
                    $set('total', $total);
                }),
            TextInput::make('item_gst')
                ->numeric()
                ->label('Item GST'),
            TextInput::make('total')
                ->disabled()
                ->dehydrated()
                ->numeric()
                ->label('Total'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item.name')->label('Item'),
                TextColumn::make('quantity'),
                TextColumn::make('gst.percentage')->label('GST %'),
                TextColumn::make('item_rate')->label('Item Rate In Rs.')->numeric(2)->summarize(
                    Sum::make()
                        ->label('Total rate')
                ),


                TextColumn::make('item_gst')->label('Item GST')->summarize(
                    Sum::make()
                        ->label('Total GST')
                ),


                TextColumn::make('total')->label('Total')
 ->summarize(
                    Sum::make()
                        ->label('Grand Total')
                ),

            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Item')
                    ->successNotification(null),
            ])
            ->actions([
                EditAction::make()
                    ->successNotification(null),
                DeleteAction::make()
                    ->successNotification(null),
            ])
            ->striped()
            ->paginated(false);
    }


}