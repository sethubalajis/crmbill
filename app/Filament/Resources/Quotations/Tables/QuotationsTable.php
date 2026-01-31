<?php

namespace App\Filament\Resources\Quotations\Tables;

use App\Filament\Resources\Invoices\InvoiceResource;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class QuotationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('quotationno')
                    ->searchable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('customer.id')
                    ->searchable(),
                TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('intrastate')
                    ->boolean(),
                TextColumn::make('gststate')
                    ->label('GST')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                Action::make('convert_to_invoice')
                    ->label('Convert to Invoice')
                    ->icon('heroicon-m-arrow-right-circle')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $invoice = DB::transaction(function () use ($record) {
                            $invoice = Invoice::create([
                                'invoicedate' => $record->date,
                                'customer_id' => $record->customer_id,
                                'total' => $record->total,
                                'cgst' => $record->gstcentral,
                                'sgst' => $record->gststate,
                                'intrastate' => (bool) $record->intrastate,
                            ]);

                            foreach ($record->quotationitems as $item) {
                                InvoiceItem::create([
                                    'invoice_id' => $invoice->id,
                                    'item_id' => $item->item_id,
                                    'gst_id' => $item->gst_id,
                                    'quantity' => $item->quantity,
                                    'item_rate' => $item->item_rate,
                                    'item_gst' => $item->item_gst,
                                    'total' => $item->total,
                                ]);
                            }

                            return $invoice;
                        });

                        return redirect(InvoiceResource::getUrl('edit', ['record' => $invoice]));
                    }),
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-m-eye')
                    ->url(fn ($record) => route('quotations.view', $record->id))
                    ->openUrlInNewTab(),
                Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->url(fn ($record) => route('quotations.download-pdf', $record->id))
                    ->openUrlInNewTab(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
