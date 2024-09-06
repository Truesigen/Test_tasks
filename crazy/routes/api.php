<?php

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

Route::controller(App\Http\Controllers\Api\v1\CategoryController::class)->group(function () {
    Route::get('/genres', 'index');
    Route::get('/genres/{id}', 'showMoviesById');
});

Route::controller(App\Http\Controllers\Api\v1\MovieController::class)->group(function () {
    Route::get('/movies', 'index');
    Route::get('/movies/{id}', 'show');
});
