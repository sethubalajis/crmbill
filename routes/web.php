<?php

use Illuminate\Support\Facades\Route;
use App\Models\Company;
use App\Models\Quotation;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quotations/{quotation}/view', function (Quotation $quotation) {
    $quotation->load('quotationitems.item.gst', 'quotationitems.gst', 'customer');
    $company = Company::with(['country', 'state', 'city'])->first();
    return view('filament.resources.quotations.pages.view-quotation', [
        'quotation' => $quotation,
        'company' => $company
    ]);
})->name('quotations.view');
