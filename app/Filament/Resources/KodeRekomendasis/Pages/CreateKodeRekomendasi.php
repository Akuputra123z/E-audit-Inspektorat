<?php

namespace App\Filament\Resources\KodeRekomendasis\Pages;

use App\Filament\Resources\KodeRekomendasis\KodeRekomendasiResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKodeRekomendasi extends CreateRecord
{
    protected static string $resource = KodeRekomendasiResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman index (ListRecommendations)
        return $this->getResource()::getUrl('index');
    }
}
