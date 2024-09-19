<?php

namespace App\Filament\Imports;

use App\Models\v1\Product;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('sku')
                ->requiredMapping(),
            ImportColumn::make('name')
                ->requiredMapping(),
            ImportColumn::make('description')
                ->requiredMapping(),
            ImportColumn::make('stock')
                ->numeric(),
            ImportColumn::make('price')
                ->numeric()
                ->rules(['numeric', 'min:0']),
            ImportColumn::make('sell_price')
                ->numeric()
                ->rules(['numeric', 'min:0'])
        ];
    }

    public function resolveRecord(): ?Product
    {
       
        return new Product();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your product import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
