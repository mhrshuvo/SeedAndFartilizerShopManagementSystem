<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            foreach ($attributes as $attribute) {
                $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
            }
           
            return $this;
        });
    }
}
