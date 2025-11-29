<?php

namespace App\Filament\Resources\KodeRekomendasis\Pages;

use App\Filament\Resources\KodeRekomendasis\KodeRekomendasiResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKodeRekomendasi extends ViewRecord
{
    protected static string $resource = KodeRekomendasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
