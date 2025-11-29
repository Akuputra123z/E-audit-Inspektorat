<?php

namespace App\Filament\Resources\Recommendations\Widgets;

use App\Models\Recommendations;
use Filament\Widgets\ChartWidget;

class TopKecamatanChart extends ChartWidget
{
    protected ?string $heading = 'Top 5 Kecamatan dengan Rekomendasi Terbanyak';

    protected function getData(): array
    {
        $data = Recommendations::selectRaw('lhp_id, COUNT(*) as total')
            ->with(['lhp:id,nama_kecamatan'])
            ->groupBy('lhp_id')
            ->get()
            ->groupBy(fn($item) => $item->lhp->nama_kecamatan ?? 'Tidak Ada Kecamatan')
            ->map(fn($group) => $group->sum('total'))
            ->sortDesc()
            ->take(5);

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Rekomendasi',
                    'data' => $data->values()->toArray(),
                ],
            ],
            'labels' => $data->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
