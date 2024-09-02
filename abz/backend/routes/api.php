<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Position;

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

Route::controller(App\Http\Controllers\Auth\SystemTokenController::class)->group(function () {
    Route::get('/system/token/create', 'store');
});

Route::controller(App\Http\Controllers\Api\v1\UserController::class)->prefix('/v1')->group(function () {
    Route::get('/users', 'show');
    Route::get('/user/{id}/show', 'getUserById')->where('id', '[0-9]+');
    Route::post('/users', 'create')->middleware('system');
});

Route::get('/v1/positions', function () {
    $positions = Position::all();

    if (!$positions) {
        return response()->json(['success' => false, 'message' => 'Positions not found']);
    }
    return response()->json(['success' => true, 'positions' => $positions]);
});
