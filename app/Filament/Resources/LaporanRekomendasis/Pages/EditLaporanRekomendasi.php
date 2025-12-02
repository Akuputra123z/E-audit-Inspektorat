<?php

namespace App\Filament\Resources\LaporanRekomendasis\Pages;

use App\Filament\Resources\LaporanRekomendasis\LaporanRekomendasiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaporanRekomendasi extends EditRecord
{
    protected static string $resource = LaporanRekomendasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
