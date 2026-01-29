<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class InvoiceStats extends StatsOverviewWidget
{
    protected ?string $heading = 'Invoices';

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
            Stat::make('Today', Invoice::query()->whereDate('created_at', $today)->count()),
            Stat::make('This Week', Invoice::query()->whereBetween('created_at', [$weekStart, $weekEnd])->count()),
            Stat::make('This Month', Invoice::query()->whereBetween('created_at', [$monthStart, $monthEnd])->count()),
            Stat::make('This Year', Invoice::query()->whereBetween('created_at', [$yearStart, $yearEnd])->count()),
        ];
    }
}
