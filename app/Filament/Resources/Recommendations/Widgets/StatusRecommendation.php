<?php

namespace App\Filament\Resources\Recommendations\Widgets;
use App\Models\Recommendations;


use Filament\Widgets\ChartWidget;

class StatusRecommendation extends ChartWidget
{
    protected ?string $heading = 'Status Recommendation';

    protected function getData(): array
    {
        $pending = Recommendations::where('status', 'pending')->count();
        $proses  = Recommendations::where('status', 'proses')->count();
        $selesai = Recommendations::where('status', 'selesai')->count();
    
        return [
            'labels' => ['Pending', 'Proses', 'Selesai'],
            'datasets' => [
                [
                    'label' => 'Status Rekomendasi',
                    'data' => [$pending, $proses, $selesai],
                    'backgroundColor' => [
                        '#facc15', // kuning
                        '#3b82f6', // biru
                        '#22c55e', // hijau
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
