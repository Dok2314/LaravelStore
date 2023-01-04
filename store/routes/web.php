<?php

use App\Http\Controllers as C;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'reset'   => false,
    'confirm' => false,
    'verify'  => false,
]);

Route::get('/', [C\MainController::class, 'index'])->name('index');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin'], function () {
        Route::resource('categories', C\Admin\CategoryController::class);
        Route::resource('products', C\Admin\ProductController::class);

        Route::group(['middleware' => 'is_admin'], function() {
            Route::get('/orders', [C\Admin\OrderController::class, 'index'])->name('home');
        });
    });

    Route::group(['prefix' => 'basket'], function () {
        Route::post('/add/{product_id}', [C\BasketController::class, 'basketAdd'])->name('basket-add');

        Route::group(['middleware' => 'basket_not_empty'], function () {
            Route::get('/', [C\BasketController::class, 'basket'])->name('basket');
            Route::get('/place', [C\BasketController::class, 'basketPlace'])->name('basket-place');
            Route::post('/confirm', [C\BasketController::class, 'basketConfirm'])->name('basket-confirm');
            Route::post('/remove/{product_id}', [C\BasketController::class, 'basketRemove'])->name('basket-remove');
        });
    });

    Route::get('/categories', [C\MainController::class, 'categories'])->name('categories');

    Route::get('/{category:slug}', [C\MainController::class, 'category'])->name('category');

    Route::get('/{category:slug}/{product:slug}', [C\MainController::class, 'product'])->name('product');
});
