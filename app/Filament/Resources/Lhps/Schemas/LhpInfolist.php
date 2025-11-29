<?php

namespace App\Filament\Resources\Lhps\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LhpInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nomor_lhp'),
                TextEntry::make('tanggal_lhp')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('nama_kecamatan')
                    ->placeholder('-'),
                TextEntry::make('jenis_pemeriksaan')
                    ->placeholder('-'),
                TextEntry::make('unit_diperiksa')
                    ->placeholder('-'),
                TextEntry::make('tim')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
