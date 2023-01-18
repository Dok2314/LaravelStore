<?php

namespace App\Providers;

use App\Services\CurrencyConversion;
use App\ViewComposers\BestProductsComposer;
use App\ViewComposers\CategoriesComposer;
use App\ViewComposers\CurrencyComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', CategoriesComposer::class);
        View::composer('*', CurrencyComposer::class);
        View::composer('*', BestProductsComposer::class);

        View::composer('*', function ($view) {
            $currencySymbol = CurrencyConversion::getCurrencySymbol();
            $view->with('currencySymbol', $currencySymbol);
        });
    }
}
