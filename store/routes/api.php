<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api as Controllers;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    $token = $user->createToken('token')->plainTextToken;

    if(!$user) return response('User not found!', 404);

    return $token;
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('skus', [Controllers\SkusController::class, 'getSkus']);
});
