<?php

use Illuminate\Support\Facades\Route;
use App\Models\Company;
use App\Models\Quotation;
use App\Models\Invoice;
use Illuminate\Support\Facades\Artisan;
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
    
    // Convert asset URLs to absolute file paths for DomPDF
    if ($company?->logo) {
        $company->logo = public_path('companies/' . $company->logo);
    }
    
    $html = view('filament.resources.quotations.pages.view-quotation', [
        'quotation' => $quotation,
        'company' => $company
    ])->render();
    
    $pdf = \PDF::loadHTML($html);
    return $pdf->download('Quotation_' . $quotation->quotationno . '.pdf');
})->name('quotations.download-pdf');

Route::get('/invoices/{invoice}/view', function (Invoice $invoice) {
    $invoice->load('items.item', 'items.gst', 'customer');
    $company = Company::with(['country', 'state', 'city'])->first();
    return view('filament.resources.invoices.pages.view-invoice', [
        'invoice' => $invoice,
        'company' => $company
    ]);
})->name('invoices.view');

Route::get('/invoices/{invoice}/download-pdf', function (Invoice $invoice) {
    $invoice->load('items.item', 'items.gst', 'customer');
    $company = Company::with(['country', 'state', 'city'])->first();
    
    // Convert asset URLs to absolute file paths for DomPDF
    if ($company?->logo) {
        $company->logo = public_path('companies/' . $company->logo);
    }
    
    $html = view('filament.resources.invoices.pages.view-invoice', [
        'invoice' => $invoice,
        'company' => $company
    ])->render();
    
    $pdf = \PDF::loadHTML($html);
    return $pdf->download('Invoice_' . $invoice->invoiceno . '.pdf');
})->name('invoices.download-pdf');




