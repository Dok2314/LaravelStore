<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Observers\ProductObserver;
use App\Services\CurrencyConversion;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('routeactive', function ($route) {
            return "<?php echo Route::currentRouteNamed($route) ? 'class=\"active\"' : ''; ?>";
        });

        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });

        Product::observe(ProductObserver::class);
    }
}
