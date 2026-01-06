<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\StatisticController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Support\Facades\Route;

Route::get('/statistic', StatisticController::class);

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->middleware('auth:sanctum');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->middleware(['auth:sanctum', EnsureUserHasRole::class.':admin,manager']);
    Route::get('/users/{id}', 'show');
    Route::put('/users/{user}', 'update')->middleware(['auth:sanctum']);
});

Route::controller(ProjectController::class)->group(function () {
    Route::get('/projects', 'index');
    Route::get('/projects/{id}', 'show');
    Route::post('/projects', 'store')->middleware(['auth:sanctum', EnsureUserHasRole::class.':admin,manager']);
    Route::put('/projects/{project}', 'update')->middleware(['auth:sanctum']);
    Route::delete('/projects/{project}', 'delete')->middleware(['auth:sanctum']);
});

Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks', 'index');
    Route::get('/tasks/{id}', 'show')->name('task.show');
    Route::post('/tasks', 'store')->middleware('auth:sanctum', EnsureUserHasRole::class.':admin,manager');
    Route::put('/tasks/{task}', 'update')->middleware('auth:sanctum');
    Route::delete('/tasks/{task}', 'delete')->middleware('auth:sanctum');
});
