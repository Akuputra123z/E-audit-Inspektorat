<?php

namespace App\Filament\Resources\UnitDiperiksas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
Use Filament\Actions\ExportAction;
use App\Filament\Exports\UnitDiperiksaExporter;
use App\Filament\Imports\UnitDiperiksaImporter;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ImportAction;
use Filament\Actions\ImportFormat;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
class UnitDiperiksasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_unit')->sortable()->searchable(),
                TextColumn::make('nama_kecamatan')->sortable()->searchable(),
                TextColumn::make('kategori')->sortable()->searchable(),
                

            
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
                        'BUMD'  => 'BUMND',
                        'Sekolah' => 'Sekolah',
                        'Sekolah SMP' => 'Sekolah SMP',
                        'Sekolah SMA' => 'Sekolah SMA',
                        'Sekolah SMK' => 'Sekolah SMK',
                        'Sekolah TK'  => 'Sekolah TK',
                    ]),

                   
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->headerActions([
                ImportAction::make()
                ->importer(UnitDiperiksaImporter::class)
                ->label('Import'),
              

                ExportAction::make()
                    ->exporter(UnitDiperiksaExporter::class)
                    ->label('Export'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
