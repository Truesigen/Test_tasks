<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DefaultController;
use App\Http\Controllers\Admin\MovieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DefaultController::class, 'index'])->name('index');
Route::get('/movies/{id}/publish', [MovieController::class, 'changeStatusById'])->name('movies.status');
Route::resource('categories', CategoryController::class);
Route::resource('movies', MovieController::class);
