<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Models\Quotation;
use Filament\Resources\Pages\Page;

class ViewQuotation extends Page
{
    protected static string $view = 'filament.resources.quotations.pages.view-quotation';

    public Quotation $quotation;

    public function mount(Quotation $quotation): void
    {
        $this->quotation = $quotation;
        $this->quotation->load('quotationitems.item', 'customer');
    }
}
