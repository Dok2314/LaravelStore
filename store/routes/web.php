<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controllers;

Route::get('/', [Controllers\MainController::class, 'index'])->name('index');
Route::get('/categories', [Controllers\MainController::class, 'categories'])->name('categories');

Route::get('/basket', [Controllers\MainController::class, 'basket'])->name('basket');

Route::get('/{category:slug}', [Controllers\MainController::class, 'category'])->name('category');

Route::get('/mobiles/{product:slug}', [Controllers\MainController::class, 'product'])->name('product');

Route::get('/basket/place', [Controllers\MainController::class, 'basketPlace'])->name('basket-place');
