<?php

namespace App\Filament\Resources\KodeTemuans\Pages;

use App\Filament\Resources\KodeTemuans\KodeTemuanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKodeTemuan extends ViewRecord
{
    protected static string $resource = KodeTemuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
