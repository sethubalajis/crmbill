<?php

namespace App\Filament\Widgets;

use App\Models\Quotation;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class QuotationStats extends StatsOverviewWidget
{
    protected ?string $heading = 'Quotations';

    protected function getStats(): array
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();
        $yearStart = Carbon::now()->startOfYear();
        $yearEnd = Carbon::now()->endOfYear();

        return [
            Stat::make('Today', Quotation::query()->whereDate('created_at', $today)->count()),
            Stat::make('This Week', Quotation::query()->whereBetween('created_at', [$weekStart, $weekEnd])->count()),
            Stat::make('This Month', Quotation::query()->whereBetween('created_at', [$monthStart, $monthEnd])->count()),
            Stat::make('This Year', Quotation::query()->whereBetween('created_at', [$yearStart, $yearEnd])->count()),
        ];
    }
}
