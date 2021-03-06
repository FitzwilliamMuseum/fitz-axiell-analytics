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
// use App\Http\Controllers\LocationMovesController;
// use App\Http\Controllers\IndexController;

Route::get('/', 'App\Http\Controllers\IndexController@index')->name('home');
Route::get('/analytics/website/{timespan?}', 'App\Http\Controllers\GoogleController@index')->name('analytics.website');
Route::get('/analytics/tessitura/{timespan?}', 'App\Http\Controllers\GoogleController@tessitura')->name('analytics.tessitura');
Route::get('/analytics/collection/{timespan?}', 'App\Http\Controllers\GoogleController@collection')->name('analytics.collection');


Route::get('/moves/on-display/{timespan?}', 'App\Http\Controllers\LocationMovesController@moves')->name('moves');
Route::get('/moves-export/on-display/{timespan?}', 'App\Http\Controllers\LocationMovesController@displayExport')->name('display.export');

Route::get('/moves/in-storage/{timespan?}', 'App\Http\Controllers\LocationMovesController@storage')->name('moves.storage');
Route::get('/moves-export/in-storage/{timespan?}', 'App\Http\Controllers\LocationMovesController@storageExport')->name('storage.export');

Route::get('/createdexport/{timespan?}', 'App\Http\Controllers\TemporalController@createdExport')->name('created.export');

Route::get('/created/{timespan?}', 'App\Http\Controllers\TemporalController@created')->name('created');
Route::get('/updatedexport/{timespan?}', 'App\Http\Controllers\TemporalController@updatedExport')->name('updated.export');

Route::get('/updated/{timespan?}', 'App\Http\Controllers\TemporalController@updated')->name('updated');
Route::get('/object/', 'App\Http\Controllers\ObjectsController@index')->name('object');
Route::get('/object/results', 'App\Http\Controllers\ObjectsController@results')->name('object.results');
