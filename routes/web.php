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
//CRUD Gendre
// Route::prefix('gendre')->group(function () {
//     Route::get('gendre/', 'GendreController@index');
//     Route::post('/save', 'GendreController@store');
//     Route::get('/{id}', 'GendreController@show');
//     Route::put('/update/{id}', 'GendreController@update');
// });

// Route::prefix('director')->group(function () {
//     Route::get('/', 'DirectorController@index');
//     Route::post('/', 'DirectorController@store');
//     Route::get('/{id}', 'DirectorController@show');
// });

// Route::prefix('actor')->group(function () {
//     Route::get('/', 'ActorController@index');
//     // Route::post('/', 'DirectorController@store');
//     // Route::get('/{id}', 'DirectorController@show');
// });

// Route::prefix('movie')->group(function () {
//     Route::get('/', 'MovieController@index');
//     // Route::post('/', 'DirectorController@store');
//     Route::get('/{id}', 'MovieController@show');
// });

