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
Route::post('/game/{wordId}', 'App\Http\Controllers\GameController@submitLetter');
Route::get('/game/word', 'App\Http\Controllers\GameController@getWord');