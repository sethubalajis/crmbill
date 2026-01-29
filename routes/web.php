<?php

use Illuminate\Support\Facades\Route;
use App\Models\Company;
use App\Models\Quotation;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quotations/{quotation}/view', function (Quotation $quotation) {
    $quotation->load('quotationitems.item', 'quotationitems.gst', 'customer');
    $company = Company::with(['country', 'state', 'city'])->first();
    return view('filament.resources.quotations.pages.view-quotation', [
        'quotation' => $quotation,
        'company' => $company
    ]);
})->name('quotations.view');

Route::get('/quotations/{quotation}/download-pdf', function (Quotation $quotation) {
    $quotation->load('quotationitems.item', 'quotationitems.gst', 'customer');
    $company = Company::with(['country', 'state', 'city'])->first();
    
    $html = view('filament.resources.quotations.pages.view-quotation', [
        'quotation' => $quotation,
        'company' => $company
    ])->render();
    
    $pdf = \PDF::loadHTML($html);
    return $pdf->download('Quotation_' . $quotation->quotationno . '.pdf');
})->name('quotations.download-pdf');
