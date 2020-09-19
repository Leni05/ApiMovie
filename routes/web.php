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

// Route::post('/mahasiswaapi/store',"GendreController@store1");
// Route::post('/gendre', [
//     'uses' => 'GendreController@store',
//     'nocsrf' => true,
//  ]);
//CRUD Gendre
Route::prefix('gendre')->group(function () {
    Route::get('/', 'GendreController@index');
    Route::post('/save', 'GendreController@store');
    Route::get('/{id}', 'GendreController@show');
    Route::put('/update/{id}', 'GendreController@update');
});

//CRUD Director
Route::prefix('director')->group(function () {
    Route::get('/', 'DirectorController@index');
    Route::post('/save', 'DirectorController@store');
    Route::get('/{id}', 'DirectorController@show');
    Route::put('/update/{id}', 'DirectorController@update');
});

//CRUD Actor
Route::prefix('actor')->group(function () {
    Route::get('/', 'ActorController@index');
    Route::post('/save', 'ActorController@store');
    Route::get('/update/{id}', 'ActorController@update');
});

//CRUD Movie
Route::prefix('movie')->group(function () {
    Route::get('/', 'MovieController@index');
    Route::post('/save', 'MovieController@store');
    Route::get('/{id}', 'MovieController@show');
    Route::put('/update/{id}', 'MovieController@update');
    Route::get('/delete/{id}', 'MovieController@destroy');
});

