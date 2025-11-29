<?php

namespace App\Filament\Resources\Recommendations\Pages;

use App\Filament\Resources\Recommendations\RecommendationsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRecommendations extends ViewRecord
{
    protected static string $resource = RecommendationsResource::class;

  
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
