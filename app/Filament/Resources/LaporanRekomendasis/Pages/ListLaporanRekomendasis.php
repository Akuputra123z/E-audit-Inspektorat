<?php

namespace App\Filament\Resources\LaporanRekomendasis\Pages;

use App\Filament\Resources\LaporanRekomendasis\LaporanRekomendasiResource;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Components\Tabs\Tab;
use App\Models\Recommendations;


class ListLaporanRekomendasis extends ListRecords
{
    protected static string $resource = LaporanRekomendasiResource::class;
    protected ?string $heading = 'Laporan Rekomendasi';

    protected function getHeaderActions(): array
    {
        return [
            // tambahkan CreateAction::make() jika ingin tombol "Create"
        ];
    }

    /**
     * Return an array of Tab objects.
     */
    public function getTabs(): array
    {
        return [
             Tab::make('Semua'),
             Tab::make('Selesai')
             ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'selesai'))
             ->badge(fn () => Recommendations::where('status', 'selesai')->count()),
            Tab::make('Proses')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'proses'))
                ->badge(fn () => Recommendations::where('status', 'proses')->count()),
            Tab::make('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(fn () => Recommendations::where('status', 'pending')->count()),

        ];
    }

  
}
