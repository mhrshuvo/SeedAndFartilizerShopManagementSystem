<?php

namespace App\Filament\Widgets;

use App\Models\v1\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class OrderChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $date = $this->getOrderPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'order',
                    'data' =>  $date['OrderPerMonth']
                ],
                [
                    'label' => 'pending',
                    'data' =>  $date['pendingOrder'],
                    'borderColor'=> "#084de0"
                ],

            ],
            'labels' => $date['months']

        ];
    }

    protected function getType(): string
    {
        return 'line';
    }


    private function getOrderPerMonth()
    {

        $orders = [];
        $pendingOrder = [];
        $months =[];
      
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('M');
            $orders[] = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->count();
            $pendingOrder[] = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->where('status','pending')->count();
        }
     

        //dd(getType($orders));
        return [
            'pendingOrder'=> $pendingOrder ,
            'OrderPerMonth' => $orders,
            'months' => $months,
        ];
    }
}
