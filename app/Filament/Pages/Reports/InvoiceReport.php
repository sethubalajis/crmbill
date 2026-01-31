<?php

namespace App\Filament\Pages\Reports;

use App\Models\Invoice;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InvoiceReport extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|\UnitEnum|null $navigationGroup = 'Reports';

    protected static ?string $navigationLabel = 'Invoice';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCurrencyDollar;

    protected static ?string $title = 'Invoice Report';

    protected string $view = 'filament.pages.reports.invoice-report';

    public function table(Table $table): Table
    {
        return $table
            ->query(Invoice::query())
            ->columns([
                TextColumn::make('invoiceno')
                    ->label('Invoice No')
                    ->searchable(),
                TextColumn::make('invoicedate')
                    ->label('Invoice Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('customer.company_name')
                    ->label('Customer')
                    ->searchable(),
                TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('intrastate')
                    ->boolean(),
                TextColumn::make('cgst')
                    ->label('CGST')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sgst')
                    ->label('SGST')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('date_range')
                    ->form([
                        DatePicker::make('from')
                            ->label('From Date'),
                        DatePicker::make('to')
                            ->label('To Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn (Builder $query, string $date): Builder => $query->whereDate('invoicedate', '>=', $date)
                            )
                            ->when(
                                $data['to'] ?? null,
                                fn (Builder $query, string $date): Builder => $query->whereDate('invoicedate', '<=', $date)
                            );
                    }),
            ])
            ->defaultSort('invoicedate', 'desc')
            ->recordActions([])
            ->toolbarActions([]);
    }
}
