<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\v1\Order;
use App\Models\v1\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Customer',User::count()-1),
            Stat::make('Total Product',Product::count()),
            Stat::make('Total Order',Order::count())
        ];
    }
}
