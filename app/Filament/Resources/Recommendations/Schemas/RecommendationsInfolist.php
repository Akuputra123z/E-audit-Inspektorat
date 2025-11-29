<?php

namespace App\Filament\Resources\Recommendations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Support\Str;


class RecommendationsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Informasi Dasar LHP
                TextEntry::make('lhp.nomor_lhp')
                    ->label('Nomor LHP')
                    ->placeholder('-'),

                TextEntry::make('lhp.jenis_pemeriksaan')
                    ->label('Jenis Pemeriksaan')
                    ->placeholder('-'),

                TextEntry::make('lhp.tim')
                    ->label('Tim Pemeriksa')
                    ->placeholder('-'),

                TextEntry::make('lhp.nama_kecamatan')
                    ->label('Kecamatan')
                    ->placeholder('-'),

                /**
                 * ==============================
                 *  UNIT DIPERIKSA (RELATION)
                 * ==============================
                 */
                TextEntry::make('lhp.unit.nama_unit')
                    ->label('Unit Diperiksa')
                    ->placeholder('-'),

                TextEntry::make('lhp.unit.kategori')
                    ->label('Kategori Unit')
                    ->placeholder('-'),

                /**
                 * ==============================
                 *  KODE TEMUAN & REKOMENDASI
                 * ==============================
                 */
                TextEntry::make('kodeTemuan.kode')
                    ->label('Kode Temuan')
                    ->placeholder('-'),

                TextEntry::make('kodeRekomendasi.kategori')
                    ->label('Kategori Rekomendasi')
                    ->placeholder('-'),

                /**
                 * ==============================
                 *  STATUS & URAIAN
                 * ==============================
                 */
                TextEntry::make('status')
                    ->label('Status')
                    ->placeholder('-'),

                TextEntry::make('uraian_rekom')
                    ->label('Uraian Rekomendasi')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('nilai_rekom')
                    ->label('Nilai Rekom')
                    ->placeholder('-'),

                TextEntry::make('uraian_temuan')
                    ->label('Uraian Temuan')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('nilai_temuan')
                    ->label('Nilai Temuan')
                    ->placeholder('-'),

                /**
                 * ==============================
                 *  TINDAK LANJUT
                 * ==============================
                 */
                TextEntry::make('no_tindak_lanjut')
                    ->label('Nomor Tindak Lanjut')
                    ->placeholder('-'),

                TextEntry::make('uraian_tindak_lanjut')
                    ->label('Uraian Tindak Lanjut')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('nilai_tindak_lanjut')
                    ->label('Nilai Tindak Lanjut')
                    ->placeholder('-'),

                    ImageEntry::make('file_tindak_lanjut')
                    ->label('Lampiran Gambar')
                    ->getStateUsing(function ($record) {
                        if (!$record->file_tindak_lanjut) {
                            return [];
                        }
                
                        // Ambil hanya file gambar
                        return collect($record->file_tindak_lanjut)
                            ->filter(function ($file) {
                                return Str::endsWith(strtolower($file), ['.jpg', '.jpeg', '.png', '.webp', '.gif']);
                            })
                            ->map(fn ($file) => asset('storage/' . $file))
                            ->toArray();
                    })
                    ->columnSpanFull()
                    // ->multiple()  // tampilkan banyak gambar
                    ->hidden(fn ($record) => empty($record->file_tindak_lanjut)),

                TextEntry::make('tanggapan')
                    ->label('Tanggapan')
                    ->placeholder('-')
                    ->columnSpanFull(),

                /**
                 * ==============================
                 *  TIMESTAMP
                 * ==============================
                 */
                TextEntry::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
