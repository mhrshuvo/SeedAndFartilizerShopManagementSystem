<?php

namespace App\Providers;

use App\Models\v1\Category;
use App\Models\v1\Order;
use App\Models\v1\Product;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
        
        //customized and added by @mhrshuvo

        Route::bind('product', function($value) {
            return Product::where('sku', $value)->orWhere('slug', $value)->get()->first();
        });

        Route::bind('category', function($value) {
            return Category::where('id', $value)->orWhere('slug', $value)->get()->first();
        });
        
        Route::bind('order', function($value) {
            return Order::where('id', $value)->orWhere('tracking_id', $value)->get()->first();
        });
    }
}
