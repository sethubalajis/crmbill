<?php

namespace App\Filament\Pages\Reports;

use App\Models\Enquiry;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;

class EnquiryReport extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|\UnitEnum|null $navigationGroup = 'Reports';

    protected static ?string $navigationLabel = 'Enquiry';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $title = 'Enquiry Report';

    protected string $view = 'filament.pages.reports.enquiry-report';

    public function table(Table $table): Table
    {
        return $table
            ->query(Enquiry::query())
            ->columns([
                TextColumn::make('date')
                    ->label('Enquiry Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('company')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('description')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('callbackdate')
                    ->label('Callback Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('callbacktime')
                    ->label('Callback Time')
                    ->time()
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
