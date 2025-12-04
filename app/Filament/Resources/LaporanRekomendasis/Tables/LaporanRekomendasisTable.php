<?php

namespace App\Filament\Resources\LaporanRekomendasis\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\Action;
use Filament\Tables\Enums\FiltersLayout;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;

class LaporanRekomendasisTable
{
    public static function configure(Table $table): Table
    {
        return $table

            // ======================================
            // COLUMNS
            // ======================================
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
                TextColumn::make('unit.nama_unit')
                    ->label('Nama Unit')
                    ->searchable()
                    ->sortable(),
            ])

            // ======================================
            // FILTERS
            // ======================================
            ->filters([
                // =====================
                // FILTER TANGGAL MULAI
                // =====================
                Filter::make('start_date')
                    ->label('Tanggal Mulai')
                    ->form([
                        DatePicker::make('start')
                            ->placeholder('Mulai')
                            ->suffixIcon('heroicon-o-calendar'),
                    ])
                    ->query(fn ($query, $data) =>
                        $query->when(
                            $data['start'] ?? null,
                            fn ($q, $value) =>
                                $q->whereDate('updated_at', '>=', $value)
                        )
                    ),

                // =====================
                // FILTER TANGGAL SELESAI
                // =====================
                Filter::make('end_date')
                    ->label('Tanggal Selesai')
                    ->form([
                        DatePicker::make('end')
                            ->placeholder('Selesai')
                            ->suffixIcon('heroicon-o-calendar'),
                    ])
                    ->query(fn ($query, $data) =>
                        $query->when(
                            $data['end'] ?? null,
                            fn ($q, $value) =>
                                $q->whereDate('updated_at', '<=', $value)
                        )
                    ),

                // =====================
                // FILTER STATUS
                // =====================
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'proses' => 'Proses',
                        'selesai' => 'Selesai',
                    ])
                    ->placeholder('Semua Status')
                    ->native(false),

                // =====================
                // FILTER NOMOR LHP
                // =====================
                SelectFilter::make('lhp_id')
                    ->label('Nomor LHP')
                    ->relationship('lhp', 'nomor_lhp')
                    ->searchable()
                    ->preload()
                    ->placeholder('Semua LHP')
                    ->native(false)
                    ->columnSpan(2), // agar lebih panjang
            ], layout: FiltersLayout::AboveContent)

            ->filtersTriggerAction(fn (Action $action) =>
                $action
                    ->button()
                    ->label('Filter Data')
                    ->color('info')
                    ->icon('heroicon-o-funnel')
            )

            // ======================================
            // ACTIONS
            // ======================================
            ->recordActions([
                Action::make('downloadPdf')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) =>
                        route('recommendations.pdf', [
                            'lhp_id' => $record->lhp_id,
                        ])
                    )
                    ->openUrlInNewTab()
                    ->color('success'),
            ])

            ->toolbarActions([]);
    }
}
