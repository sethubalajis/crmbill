<?php

namespace App\Filament\Resources\Gsts\Pages;

use App\Filament\Resources\Gsts\GstResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGsts extends ListRecords
{
    protected static string $resource = GstResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
