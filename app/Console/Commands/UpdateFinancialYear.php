<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Services\FinancialYear;
use Illuminate\Console\Command;

class UpdateFinancialYear extends Command
{
    protected $signature = 'app:update-financial-year';

    protected $description = 'Update financial year on April 1';

    public function handle(): int
    {
        $year = FinancialYear::current();

        Setting::updateOrCreate(
            ['key' => 'current_financial_year'],
            ['value' => $year]
        );

        $this->info("Financial year updated to {$year}");

        return Command::SUCCESS;
    }
}
