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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('gendre')->group(function () {
    Route::get('/', 'GendreController@index');
    Route::post('/', 'GendreController@store');
    Route::get('/{id}', 'GendreController@show');
});

Route::prefix('director')->group(function () {
    Route::get('/', 'DirectorController@index');
    // Route::post('/save', 'GendreController@data');
    // Route::get('/{id}', 'GendreController@show');
});
