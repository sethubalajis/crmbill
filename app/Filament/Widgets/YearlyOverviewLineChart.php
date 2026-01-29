<?php

namespace App\Filament\Widgets;

use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\Quotation;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class YearlyOverviewLineChart extends ChartWidget
{
    protected ?string $heading = 'Yearly Overview (Line)';

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
                    'label' => 'Enquiries',
                    'data' => [$enquiries],
                    'borderColor' => 'rgba(59, 130, 246, 1)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'fill' => true,
                ],
                [
                    'label' => 'Quotations',
                    'data' => [$quotations],
                    'borderColor' => 'rgba(245, 158, 11, 1)',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.2)',
                    'fill' => true,
                ],
                [
                    'label' => 'Invoices',
                    'data' => [$invoices],
                    'borderColor' => 'rgba(16, 185, 129, 1)',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)',
                    'fill' => true,
                ],
            ],
            'labels' => ['This Year'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
