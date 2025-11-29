<?php

namespace App\Filament\Resources\KodeRekomendasis\Pages;

use App\Filament\Resources\KodeRekomendasis\KodeRekomendasiResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditKodeRekomendasi extends EditRecord
{
    protected static string $resource = KodeRekomendasiResource::class;
    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman index (ListRecommendations)
        return $this->getResource()::getUrl('index');
    }
    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
