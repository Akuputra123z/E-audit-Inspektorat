<?php

namespace App\Filament\Resources\Recommendations\Tables;

use App\Filament\Exports\RecommendationsExporter;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\RecommendationsPdfController;

class RecommendationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->sortable(false)
                    ->alignCenter(),

                TextColumn::make('lhp.nomor_lhp')
                    ->label('Nomor LHP')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('lhp.nama_kecamatan')
                    ->label('Kecamatan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('lhp.unit.nama_unit')
                    ->label('Nama Unit')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kodeTemuan.kode')
                    ->label('Kode Temuan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kodeRekom.kode')
                    ->label('Kode Rekomendasi')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'pending' => 'warning',
                        'proses'  => 'info',
                        'selesai' => 'success',
                        default   => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('nilai_rekom')
                    ->label('Nilai Rekom')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('no_tindak_lanjut')
                    ->label('Nomor TL')
                    ->searchable(),

                TextColumn::make('nilai_tindak_lanjut')
                    ->label('Nilai TL')
                    ->numeric()
                    ->sortable(),

                ImageColumn::make('file_tindak_lanjut')
                    ->label('Lampiran')
                    ->disk('public')
                    ->limit(3)
                    ->getStateUsing(fn ($record) => collect($record->file_tindak_lanjut ?? [])
                        ->filter(fn ($file) => preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $file))
                        ->values()
                        ->toArray()
                    ),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')

            ->filters([

                /* --- FILTER TANGGAL BUATAN --- */
                Filter::make('created_at')
                    ->label('Created Date')
                    ->form([
                        DatePicker::make('created_from')->label('Created From'),
                        DatePicker::make('created_until')->label('Created Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date) => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date) => $query->whereDate('created_at', '<=', $date)
                            );
                    }),

                /* --- FILTER KATEGORI UNIT --- */
                SelectFilter::make('kategori')
                    ->label('Kategori Unit')
                    ->options([
                        'OPD'     => 'OPD',
                        'Desa'    => 'Desa',
                        'Bumdes'  => 'Bumdes',
                        'Sekolah' => 'Sekolah',
                    ])
                    ->query(fn (Builder $query, $value) =>
                        $value ? $query->whereHas('lhp.unit', fn ($q) => $q->where('kategori', $value)) : $query
                    ),

                /* --- FILTER STATUS --- */
                SelectFilter::make('status')
                    ->label('Status Rekomendasi')
                    ->options([
                        'pending' => 'Pending',
                        'proses'  => 'Proses',
                        'selesai' => 'Selesai',
                    ]),
            ])

            ->recordActions([
                ViewAction::make(),
                EditAction::make(),

                /* --- DOWNLOAD PDF PER LHP --- */
                Action::make('downloadPdf')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) =>
                        route('recommendations.pdf', [
                            'lhp_id' => $record->lhp_id
                        ])
                    )
                    ->openUrlInNewTab()
                    ->color('success'),
            ])

            ->headerActions([
                ExportAction::make()
                    ->exporter(RecommendationsExporter::class)
                    ->label('Export'),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
            
                    ExportBulkAction::make('exportSelected')
                        ->exporter(RecommendationsExporter::class)
                        ->label('Export Selected')
                        ->icon('heroicon-o-arrow-up-tray')
                        ->modifyQueryUsing(fn ($query) => $query),
                ]),
                        
            
            ]);
    }
}
