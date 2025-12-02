<?php

namespace App\Filament\Resources\LaporanRekomendasis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class LaporanRekomendasisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lhp.nomor_lhp')
                    ->label('Nomor LHP')
                    ->searchable()
                    ->sortable(),

                  TextColumn::make('kodeTemuan.kode')
                    ->label('Kode Temuan')
                    ->searchable(),

                  TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'proses',
                        'success' => 'selesai',
                    ]),

                  TextColumn::make('nilai_rekom')
                    ->numeric()
                    ->label('Nilai Rekomendasi'),

                  TextColumn::make('updated_at')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
