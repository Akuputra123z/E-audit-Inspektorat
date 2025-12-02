<?php

namespace App\Filament\Resources\Lhps\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LhpsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_lhp')
                ->label('Nomor LHP')
                ->searchable()
                ->sortable(),

            // Tanggal
            TextColumn::make('tanggal_lhp')
                ->label('Tanggal LHP')
                ->date()
                ->sortable(),

            // Kecamatan
            TextColumn::make('nama_kecamatan')
                ->label('Kecamatan')
                ->searchable()
                ->sortable(),

            // Jenis Pemeriksaan
            TextColumn::make('jenis_pemeriksaan')
                ->label('Jenis Pemeriksaan')
                ->searchable()
                ->sortable(),

            // Kategori Unit (disimpan di LHP)
            TextColumn::make('kategori_unit')
                ->label('Kategori')
                ->badge()
                ->colors([
                    'primary' => 'OPD',
                    'success' => 'Desa',
                    'warning' => 'Bidang',
                    'info'    => 'Sekolah',
                ])
                ->searchable()
                ->sortable(),

            // Nama unit dari tabel relasi
            TextColumn::make('unit.nama_unit')
                ->label('Nama Unit Diperiksa')
                ->searchable()
                ->sortable(),

            // Tim Pemeriksa
            TextColumn::make('tim')
                ->label('Tim Pemeriksa')
                ->wrap()
                ->searchable(),

            // Created at
            TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime()
                ->since() // tampil: “2 hari lalu”
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc') 
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
