<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getWidgets(): array
    {
        return [
            OrderResource\Widgets\OrderStats::class,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderResource\Widgets\OrderStats::class,
        ];
    }
}
