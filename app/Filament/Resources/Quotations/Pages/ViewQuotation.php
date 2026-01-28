<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Models\Company;
use App\Models\Quotation;
use Filament\Resources\Pages\Page;

class ViewQuotation extends Page
{
    protected string $view = 'filament.resources.quotations.pages.view-quotation';

    public Quotation $quotation;
    public Company $company;

    public function mount(Quotation $quotation): void
    {
        $this->quotation = $quotation;
        $this->quotation->load('quotationitems.item.gst', 'customer');
        $this->company = Company::first();
    }
}
