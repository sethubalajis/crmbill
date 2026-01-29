<?php

namespace App\Filament\Widgets;

use App\Models\Enquiry;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class EnquiryStats extends StatsOverviewWidget
{
    protected ?string $heading = 'Enquiries';

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
            Stat::make('Today', Enquiry::query()->whereDate('created_at', $today)->count()),
            Stat::make('This Week', Enquiry::query()->whereBetween('created_at', [$weekStart, $weekEnd])->count()),
            Stat::make('This Month', Enquiry::query()->whereBetween('created_at', [$monthStart, $monthEnd])->count()),
            Stat::make('This Year', Enquiry::query()->whereBetween('created_at', [$yearStart, $yearEnd])->count()),
        ];
    }
}
