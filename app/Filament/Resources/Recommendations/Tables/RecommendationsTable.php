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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class RecommendationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()      // otomatis 1,2,3,... per halaman
                    ->sortable(false)
                    ->alignCenter(),
                /**
                 * ============================
                 *  RELASI LHP
                 * ============================
                 */
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


                /**
                 * ============================
                 *  KODE TEMUAN (RELATION)
                 * ============================
                 */
                TextColumn::make('kodeTemuan.kode')
                    ->label('Kode Temuan')
                    ->sortable()
                    ->searchable(),

                /**
                 * ============================
                 *  KODE REKOMENDASI
                 * ============================
                 */
                TextColumn::make('kodeRekomendasi.kategori')
                ->label('Kategori Rekom')
                ->sortable()
                ->searchable(),
            
                TextColumn::make('kodeRekom.kode')
                    ->label('Kode Rekomendasi')
                    ->sortable()
                    ->searchable(),

                /**
                 * ============================
                 *  STATUS BADGE
                 * ============================
                 */
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

                /**
                 * ============================
                 *  NILAI REKOMENDASI
                 * ============================
                 */
                TextColumn::make('nilai_rekom')
                    ->label('Nilai Rekom')
                    ->numeric()
                    ->sortable(),
                    

                /**
                 * ============================
                 *  TINDAK LANJUT
                 * ============================
                 */
                TextColumn::make('no_tindak_lanjut')
                    ->label('Nomor TL')
                    ->searchable(),

                TextColumn::make('nilai_tindak_lanjut')
                    ->label('Nilai TL')
                    ->numeric()
                    ->sortable(),

                /**
                 * ============================
                 *  FILE TINDAK LANJUT
                 * ============================
                 */
                ImageColumn::make('file_tindak_lanjut')
                    ->label('Lampiran')
                    ->disk('public')
                    ->limit(3)
                    ->getStateUsing(fn ($record) => collect($record->file_tindak_lanjut ?? [])
                        ->filter(fn ($file) => preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $file))
                        ->values()
                        ->toArray()
                    ),

                /**
                 * ============================
                 *  TANGGAL
                 * ============================
                 */
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(),

            ])
            ->filters([
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
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                    SelectFilter::make('kategori')
                    ->label('Kategori Unit')
                    ->options([
                        'OPD'     => 'OPD',
                        'Desa'    => 'Desa',
                        'Bumdes'  => 'Bumdes',
                        'Sekolah' => 'Sekolah',
                    ]),
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
            ])
            ->headerActions([
             
                ExportAction::make()
                    ->exporter(RecommendationsExporter::class)
                    ->label('Export'),
            ])
            

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
