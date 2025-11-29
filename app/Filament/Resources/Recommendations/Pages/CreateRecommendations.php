<?php

namespace App\Filament\Resources\Recommendations\Pages;

use App\Filament\Resources\Recommendations\RecommendationsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRecommendations extends CreateRecord
{
    protected static string $resource = RecommendationsResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman index (ListRecommendations)
        return $this->getResource()::getUrl('index');
    }
}
