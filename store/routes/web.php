<?php

use App\Http\Controllers as C;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'reset'   => false,
    'confirm' => false,
    'verify'  => false,
]);

Route::get('locale/{locale}', [C\MainController::class, 'changeLocale'])->name('locale');
Route::get('currency/{currency}', [C\MainController::class, 'changeCurrency'])->name('currency');

Route::get('reset', [C\ResetController::class, 'reset'])->name('reset_db');

Route::get('/', [C\MainController::class, 'index'])->middleware('set_locale')->name('index');

Route::group(['middleware' => ['auth', 'set_locale']], function () {

    Route::group(['prefix' => 'person', 'as' => 'person.'], function () {
        Route::get('/orders', [C\Person\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}',[C\Person\OrderController::class, 'show'])->name('orders.show');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::resource('categories', C\Admin\CategoryController::class);
        Route::resource('products', C\Admin\ProductController::class);
        Route::resource('products/{product}/skus', C\Admin\SkuController::class);
        Route::resource('properties', C\Admin\PropertyController::class);
        Route::resource('coupons', C\Admin\CouponController::class);
        Route::resource('properties/{property}/property-options', C\Admin\PropertyOptionController::class);

        Route::group(['middleware' => 'is_admin'], function() {
            Route::get('/orders', [C\Admin\OrderController::class, 'index'])->name('home');
            Route::get('/orders/{order}', [C\Admin\OrderController::class, 'show'])->name('orders.show');
        });
    });

    Route::group(['prefix' => 'basket'], function () {
        Route::post('/add/{sku}', [C\BasketController::class, 'basketAdd'])->name('basket-add');

        Route::group(['middleware' => 'basket_not_empty'], function () {
            Route::get('/', [C\BasketController::class, 'basket'])->name('basket');
            Route::get('/place', [C\BasketController::class, 'basketPlace'])->name('basket-place');
            Route::post('/confirm', [C\BasketController::class, 'basketConfirm'])->name('basket-confirm');
            Route::post('/remove/{sku}', [C\BasketController::class, 'basketRemove'])->name('basket-remove');
            Route::post('coupon', [C\BasketController::class, 'setCoupon'])->name('set-coupon');
        });
    });

    Route::get('categories', [C\MainController::class, 'categories'])->name('categories');
    Route::post('subscription/{sku}', [C\MainController::class, 'subscribe'])->name('subscription');

    Route::get('/{category:slug}', [C\MainController::class, 'category'])->name('category');

    Route::get('/{category:slug}/{product:slug}/{sku}', [C\MainController::class, 'sku'])->name('sku');
});
