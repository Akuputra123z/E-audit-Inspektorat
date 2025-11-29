<?php

namespace App\Filament\Resources\KodeTemuans\Pages;

use App\Filament\Resources\KodeTemuans\KodeTemuanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditKodeTemuan extends EditRecord
{
    protected static string $resource = KodeTemuanResource::class;

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
