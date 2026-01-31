<?php

namespace App\Services;

use Carbon\Carbon;

class FinancialYear
{
    public static function current(): string
    {
        $now = Carbon::now();

        if ($now->month >= 4) {
            $start = $now->year;
            $end = $now->year + 1;
        } else {
            $start = $now->year - 1;
            $end = $now->year;
        }

        return substr($start, -2) . '-' . substr($end, -2) ;
    }
}
