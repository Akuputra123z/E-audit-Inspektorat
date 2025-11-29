<?php

namespace App\Filament\Imports;

use App\Models\UnitDiperiksa;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class UnitDiperiksaImporter extends Importer
{
    protected static ?string $model = UnitDiperiksa::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nama_unit')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('kategori'),
            ImportColumn::make('nama_kecamatan'),

        ];
    }

    public function resolveRecord(): UnitDiperiksa
    {
        return new UnitDiperiksa();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your unit diperiksa import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
