<?php

namespace App\Filament\Exports;

use App\Models\Recommendations;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class RecommendationsExporter extends Exporter
{
    protected static ?string $model = Recommendations::class;

    public static function getColumns(): array
    {
        return [


            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('no')
                ->label('No')
                ->state(function ($record) {
                    static $rowNumber = 0;
                    $rowNumber++;
                    return $rowNumber;
                }),
            // ============================
            // RELASI LHP
            // ============================
            ExportColumn::make('lhp.nomor_lhp')
                ->label('Nomor LHP'),
            ExportColumn::make('lhp.nama_kecamatan')
                ->label('Kecamatan'),

            ExportColumn::make('lhp.unit.nama_unit')
                ->label('Nama Unit'),

            // ============================
            // RELASI KODE TEMUAN
            // ============================
            ExportColumn::make('kodeTemuan.kode')
                ->label('Kode Temuan'),

            // ============================
            // RELASI KODE REKOM
            // ============================
            ExportColumn::make('kodeRekom.kode')
                ->label('Kode Rekomendasi'),

            // ============================
            // FIELD REKOMENDASI
            // ============================
            ExportColumn::make('status'),
            ExportColumn::make('uraian_rekom'),
            ExportColumn::make('nilai_rekom'),

            // ============================
            // FIELD TEMUAN
            // ============================
            ExportColumn::make('uraian_temuan'),
            ExportColumn::make('nilai_temuan'),

            // ============================
            // TINDAK LANJUT
            // ============================
            ExportColumn::make('no_tindak_lanjut'),
            ExportColumn::make('uraian_tindak_lanjut'),
            ExportColumn::make('nilai_tindak_lanjut'),

            // PDF / IMAGE FILE
            ExportColumn::make('file_tindak_lanjut'),

            // TANGGAPAN
           
          
           
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Export selesai. Total '
            . Number::format($export->successful_rows)
            . ' baris berhasil diekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '
                . Number::format($failedRowsCount)
                . ' baris gagal diekspor.';
        }

        return $body;
    }
}
