<?php

namespace App\Filament\Resources\PreLovedResource\Pages;

use App\Filament\Resources\PreLovedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPreLoved extends EditRecord
{
    protected static string $resource = PreLovedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
