<?php

namespace App\Filament\Resources\Lhps\Pages;

use App\Filament\Resources\Lhps\LhpResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLhp extends CreateRecord
{
    protected static string $resource = LhpResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman index (ListRecommendations)
        return $this->getResource()::getUrl('index');
    }
}
