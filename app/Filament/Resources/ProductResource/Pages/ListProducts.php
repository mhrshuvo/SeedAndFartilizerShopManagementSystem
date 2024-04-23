<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\v1\Product;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Support\Collection;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use App\Filament\Imports\ProductImporter;
use Filament\Actions\ImportAction;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            ImportAction::make()
            ->importer(ProductImporter::class)

        ];
    }
    public Collection $activeAndInactiveCount;

    public function __construct()
    {
        $this->activeAndInactiveCount =  Product::select('active', DB::raw('count(*) as product_count'))
            ->groupBy('active')
            ->pluck('product_count', 'active');
    }
    public function getTabs(): array
    {
        return [
            'All' => Tab::make('All')
                ->modifyQueryUsing(function ($query) {
                    $query->latest();
                }),
            'Active' => Tab::make('Active')
                ->badge($this->activeAndInactiveCount[1] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('active', 1)
                        ->latest();
                }),
            'Inactive' => Tab::make('InActive')
                ->badge($this->activeAndInactiveCount[0] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('active', 0)
                        ->latest();
                }),

        ];
    }
}
