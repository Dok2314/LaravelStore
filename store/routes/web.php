<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controllers;

Route::get('/', [Controllers\MainController::class, 'index'])->name('index');
Route::get('/categories', [Controllers\MainController::class, 'categories'])->name('categories');

Route::get('/{category}', [Controllers\MainController::class, 'category'])->name('category');

Route::get('/{category}/{product}', [Controllers\MainController::class, 'product'])->name('product');

Route::get('/basket', [Controllers\MainController::class, 'basket'])->name('basket');

Route::get('/basket/place', [Controllers\MainController::class, 'basketPlace'])->name('basket-place');
