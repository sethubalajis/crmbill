<?php

namespace App\Filament\Resources\Invoices\Pages;

use App\Models\Company;
use App\Models\Invoice;
use Filament\Resources\Pages\Page;

class ViewInvoice extends Page
{
    protected string $view = 'filament.resources.invoices.pages.view-invoice';

    public Invoice $invoice;
    public Company $company;

    public function mount(Invoice $invoice): void
    {
        $this->invoice = $invoice;
        $this->invoice->load('items.item.gst', 'customer');
        $this->company = Company::first();
    }
}
