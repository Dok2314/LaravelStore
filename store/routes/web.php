<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as C;

Route::get('/', [C\MainController::class, 'index'])->name('index');
Route::get('/categories', [C\MainController::class, 'categories'])->name('categories');

Route::get('/basket', [C\BasketController::class, 'basket'])->name('basket');

Route::get('/basket/place', [C\BasketController::class, 'basketPlace'])->name('basket-place');

Route::post('/basket/confirm', [C\BasketController::class, 'basketConfirm'])->name('basket-confirm');

Route::get('/{category:slug}', [C\MainController::class, 'category'])->name('category');

Route::get('/{category:slug}/{product:slug}', [C\MainController::class, 'product'])->name('product');

Route::post('/basket/add/{product_id}', [C\BasketController::class, 'basketAdd'])->name('basket-add');
Route::post('/basket/remove/{product_id}', [C\BasketController::class, 'basketRemove'])->name('basket-remove');
