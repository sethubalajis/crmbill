<?php

namespace App\Filament\Resources\Gsts\Pages;

use App\Filament\Resources\Gsts\GstResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGst extends EditRecord
{
    protected static string $resource = GstResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
