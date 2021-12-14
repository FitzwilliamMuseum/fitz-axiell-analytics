<?php

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
use App\Http\Controllers\LocationMovesController;

Route::view('/', 'select');
// Route::get('/moves', [LocationMovesController::class, 'view'])->name('moves');
Route::get('/moves/{timespan?}', 'App\Http\Controllers\LocationMovesController@moves')->name('moves');
