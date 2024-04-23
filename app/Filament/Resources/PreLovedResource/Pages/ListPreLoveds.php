<?php

namespace App\Filament\Resources\PreLovedResource\Pages;

use App\Filament\Resources\PreLovedResource;
use App\Models\v1\PreLoved;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ListPreLoveds extends ListRecords
{
    protected static string $resource = PreLovedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public Collection $seeOrDonateCount;
    Public Collection $statusCount;

    public function __construct()
    {
        $this->seeOrDonateCount =  PreLoved::select('want_to_do', DB::raw('count(*) as pre_loved_count'))
            ->groupBy('want_to_do')
            ->pluck('pre_loved_count', 'want_to_do');
        $this->statusCount =  PreLoved::select('status', DB::raw('count(*) as pre_loved_count'))
            ->groupBy('status')
            ->pluck('pre_loved_count', 'status');
    }

    public function getTabs(): array
    {
        return [


            'Pending' => Tab::make('Pending')
                ->badge($this->statusCount['pending'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', 'pending')
                        ->latest();
                }),
            'Approved' => Tab::make('Approved')
                ->badge($this->statusCount['approved'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', 'approved')
                        ->latest();
                }),
            'Rejected' => Tab::make('Rejected')
                ->badge($this->statusCount['rejected'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', 'rejected')
                        ->latest();
                }),
            'Live' => Tab::make('Live')
                ->badge($this->statusCount['live'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', 'live')
                        ->latest();
                }),
            'Down' => Tab::make('Down')
                ->badge($this->statusCount['down'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', 'down')
                        ->latest();
                }),
            'All' => Tab::make('All')
                ->modifyQueryUsing(function ($query) {
                    $query->latest();
                }),
            'Sell' => Tab::make('Sell')
                ->badge($this->seeOrDonateCount['sell'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('want_to_do', 'sell')
                        ->latest();
                }),
            'Donate' => Tab::make('Donate')
                ->badge($this->seeOrDonateCount['donate'] ?? 0)
                ->modifyQueryUsing(function ($query) {
                    $query->where('want_to_do', 'donate')
                        ->latest();
                }),


        ];
    }
}
