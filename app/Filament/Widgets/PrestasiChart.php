<?php

namespace App\Filament\Widgets;

use App\Models\Prestasi;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PrestasiChart extends ChartWidget
{
    protected static ?string $heading = 'Prestasi Berdasarkan Tingkatan';
    protected int|string|array $columnSpan = 'full';

    // Atur urutan widget (opsional, sesuaikan dengan widget lain)
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        // 1. Ambil data dari database, sama seperti query widget stats
        $data = Prestasi::query()
            ->select('tingkat', DB::raw('count(*) as total'))
            ->groupBy('tingkat')
            ->pluck('total', 'tingkat');

        // 2. Siapkan data untuk format chart
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Prestasi',
                    'data' => $data->values()->all(), // Array berisi jumlah [10, 5, 20]
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ],
                ],
            ],
            'labels' => $data->keys()->all(), // Array berisi label ['Nasional', 'Kota', 'Provinsi']
        ];
    }

    protected function getType(): string
    {
        // 3. Tentukan tipe grafiknya
        return 'bar'; // Anda juga bisa ganti ke 'pie', 'doughnut', 'line'
    }
}
