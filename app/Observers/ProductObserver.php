<?php

namespace App\Observers;

use App\Models\v1\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductObserver
{

    public function creating(Product $product): void
    {
        $product->slug = Str::slug($product->name);
        $product->user_id = auth()->user()->id;
        if (empty($product->sku)) {
            $product->sku = substr(Str::uuid(), 4, 8) . Carbon::now()->format('s');
        };
       // $product->serial = Product::max('serial')? Product::max('serial') + 1 : 1;
    }
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
