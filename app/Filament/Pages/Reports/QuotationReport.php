<?php

namespace App\Filament\Pages\Reports;

use App\Models\Quotation;
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

class QuotationReport extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|\UnitEnum|null $navigationGroup = 'Reports';

    protected static ?string $navigationLabel = 'Quotation';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $title = 'Quotation Report';

    protected string $view = 'filament.pages.reports.quotation-report';

    public function table(Table $table): Table
    {
        return $table
            ->query(Quotation::query())
            ->columns([
                TextColumn::make('quotationno')
                    ->label('Quotation No')
                    ->searchable(),
                TextColumn::make('date')
                    ->label('Date')
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
                TextColumn::make('gststate')
                    ->label('GST')
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
                                fn (Builder $query, string $date): Builder => $query->whereDate('date', '>=', $date)
                            )
                            ->when(
                                $data['to'] ?? null,
                                fn (Builder $query, string $date): Builder => $query->whereDate('date', '<=', $date)
                            );
                    }),
            ])
            ->defaultSort('date', 'desc')
            ->recordActions([])
            ->toolbarActions([]);
    }
}
