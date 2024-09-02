<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(App\Http\Controllers\Api\ProductController::class)->group(function () {
    Route::get('/products', 'getProducts');
    Route::get('/products/{id}', 'showProductById');
    Route::get('/products/{category}/show', 'showProductsByCategory');
});

Route::controller(App\Http\Controllers\Api\OrderController::class)->group(function () {
    Route::post('/orders', 'store');
});
