<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use App\Filament\Resources\OrderResource\Pages\ListOrders;

class OrderStats extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListOrders::class;
    }

    protected function getStats(): array
    {
        $currency_symbol = config('settings.currency_symbol', 'Rp ');

        $totalOrders = $this->getPageTableQuery()->count();
        $totalIncome = $this->getPageTableQuery()->sum('total_price');
        $formattedIncome = $currency_symbol . number_format($totalIncome, 0, ',', '.');

        return [
            Stat::make('Jumlah Pesanan', $totalOrders)
                ->description("Total pesanan")
                ->descriptionIcon('heroicon-o-inbox-stack', IconPosition::Before)
                ->chart([1, 5, 10, 50])
                ->color('success'),

            Stat::make('Total Pemasukan', $formattedIncome)
                ->description("Total pemasukan dari pesanan")
                ->descriptionIcon('heroicon-o-banknotes', IconPosition::Before)
                ->chart([1, 5, 30, 50])
                ->color('success'),
        ];
    }
}
