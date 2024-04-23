<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\v1\Order;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords\Tab;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
           // Actions\CreateAction::make(),
        ];
    }
    public Collection $orderCountBasedOnStatus;
    public function __construct()
    {
        $this->orderCountBasedOnStatus =  Order::select('status', DB::raw('count(*) as order_count'))
            ->groupBy('status')
            ->pluck('order_count', 'status');
    }

    public function getTabs(): array
    {


        return [

            'Pending' => Tab::make('Pending')
                ->badge($this->orderCountBasedOnStatus['pending'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', 'pending')
                        ->latest();
                }),
            'Confirmed' => Tab::make('Confirm')
                ->badge($this->orderCountBasedOnStatus['confirm'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', 'confirm')
                        ->latest();
                }),
            'Processing' => Tab::make('Processing')
                ->badge($this->orderCountBasedOnStatus['processing'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', 'processing')
                        ->latest();
                }),
            'On Delivery' => Tab::make('On Delivery')
                ->badge($this->orderCountBasedOnStatus['on_delivery'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', 'on_delivery')
                        ->latest();
                }),
            'Delivered' => Tab::make('Delivered')
                ->badge($this->orderCountBasedOnStatus['delivered'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', 'delivered')
                        ->latest();
                }),
            'Canceled' => Tab::make('Canceled')
                ->badge($this->orderCountBasedOnStatus['canceled'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', 'canceled')
                        ->latest();
                }),
            'All' => Tab::make('All')
                ->modifyQueryUsing(function ($query) {
                    $query->latest();
                }),

        ];
    }
}
