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

Route::controller('App\Http\Controllers\Api\v1\UserController')->prefix('/v1')->group(function () {
    Route::post('/tokens/create', 'create');
});

Route::controller('App\Http\Controllers\API\v1\CollectionsController')->middleware('auth:sanctum')->prefix('/v1')->group(function () {
    Route::get('/collections', 'index');
    Route::get('/collections/{collection}/show', 'show');
    Route::get('/collections/filtered', 'findByTargetAmount');
    Route::post('/collections/add', 'create');
});

Route::controller('App\Http\Controllers\API\v1\ContributorsController')->middleware('auth:sanctum')->prefix('/v1')->group(function () {
    Route::post('/contributors/{collection}/add', 'create');
});
