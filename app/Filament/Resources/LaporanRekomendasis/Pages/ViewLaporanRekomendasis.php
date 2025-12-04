<?php

namespace App\Filament\Resources\LaporanRekomendasis\Pages;


use Filament\Actions\EditAction;
use App\Filament\Resources\LaporanRekomendasis\LaporanRekomendasiResource;
use Filament\Resources\Pages\ViewRecord;

class ViewLaporanRekomendasis extends ViewRecord
{

  

    protected static string $resource = 'App\Filament\Resources\LaporanRekomendasis\LaporanRekomendasiResource';

  
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
