<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order as Pesanan;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Pesanan per Bulan';

    protected static ?int $sort = 1;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getHeight(): string
    {
        return '00px'; // ✅ Ukuran tinggi diperbesar di sini
    }

    protected function getData(): array
    {
        $ordersCount = Pesanan::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $ordersCount[$i] ?? 0;
        }

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December',
        ];

        return [
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'Pesanan',
                    'data' => $data,
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.5)',
                    'fill' => true,
                    'tension' => 0.3, // Opsional: bikin garis halus
                    'borderWidth' => 3, // ✅ Perbesar garis
                ],
            ],
        ];
       
    }
}
