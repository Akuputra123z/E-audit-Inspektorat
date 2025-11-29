<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Lhp;
use App\Models\TemuanLhp;
use App\Models\Recommendations;
use App\Models\UnitDiperiksa;

class AuditStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total LHP', Lhp::count()),   
            Stat::make('Total UnitDiperiksa', UnitDiperiksa::count()),
            Stat::make('Total Rekomendasi', Recommendations::count()),
            Stat::make('Rekomendasi Selesai', Recommendations::where('status', 'selesai')->count())
                ->description('Sudah Tuntas')
                ->color('success')
                ->descriptionIcon('heroicon-o-check-badge'),
        ];
    }
}
