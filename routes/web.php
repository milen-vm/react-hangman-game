<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/game', 'App\Http\Controllers\GameController@index');
Route::get('/game/word', 'App\Http\Controllers\GameController@getWord');
Route::get('/game/history','App\Http\Controllers\GameController@index');
Route::get('/game/review/{id}','App\Http\Controllers\GameController@index');