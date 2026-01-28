<?php

use Illuminate\Support\Facades\Route;
use App\Models\Quotation;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quotations/{quotation}/view', function (Quotation $quotation) {
    return view('filament.resources.quotations.pages.view-quotation', ['quotation' => $quotation]);
})->name('quotations.view');
