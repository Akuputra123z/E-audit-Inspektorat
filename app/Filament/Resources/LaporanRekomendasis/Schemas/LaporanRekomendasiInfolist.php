<?php

namespace App\Filament\Resources\LaporanRekomendasis\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;


class LaporanRekomendasiInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
            ]);
    }
}
