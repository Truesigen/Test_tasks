<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(App\Http\Controllers\Api\LoginController::class)->group(function () {
    Route::post('/login', 'login');
});

Route::controller(App\Http\Controllers\Api\UserController::class)->group(function () {
    Route::get('/info', 'getUsers')->middleware('auth:sanctum');
    Route::post('/info', 'createUser')->middleware('auth:sanctum');
});
