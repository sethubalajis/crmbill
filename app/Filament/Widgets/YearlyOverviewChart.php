<?php

namespace App\Filament\Widgets;

use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\Quotation;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class YearlyOverviewChart extends ChartWidget
{
    protected ?string $heading = 'Yearly Overview';

    protected function getData(): array
    {
        $yearStart = Carbon::now()->startOfYear();
        $yearEnd = Carbon::now()->endOfYear();

        $enquiries = Enquiry::query()->whereBetween('created_at', [$yearStart, $yearEnd])->count();
        $quotations = Quotation::query()->whereBetween('created_at', [$yearStart, $yearEnd])->count();
        $invoices = Invoice::query()->whereBetween('created_at', [$yearStart, $yearEnd])->count();

        return [
            'datasets' => [
                [
                    'label' => 'Count',
                    'data' => [$enquiries, $quotations, $invoices],
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                    ],
                ],
            ],
            'labels' => ['Enquiries', 'Quotations', 'Invoices'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
