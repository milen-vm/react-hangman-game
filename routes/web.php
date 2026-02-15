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
Route::get('/pinfo', function () {
    return phpinfo();
});
/**
 * portfolio
 */

/**
 * hangman game and React staf
 */
Route::get('/game', 'App\Http\Controllers\GameController@index');
Route::get('/game/word', 'App\Http\Controllers\GameController@getWord');
Route::get('/game/history','App\Http\Controllers\GameController@index');
Route::get('/game/review/{id}','App\Http\Controllers\GameController@index');
Route::get('/binary', 'App\Http\Controllers\GameController@index');
/**
 * Galleries
 */
Route::get('/gallery', 'App\Http\Controllers\GalleryController@index')->name('gallery.index');
Route::get('/gallery/list', 'App\Http\Controllers\GalleryController@list')->name('gallery.list');
Route::get('/gallery/create', 'App\Http\Controllers\GalleryController@create')->name('gallery.create');
Route::post('/gallery/create', 'App\Http\Controllers\GalleryController@store')->name('gallery.store');
Route::get('/gallery/{gallery}/show/{index?}', 'App\Http\Controllers\GalleryController@show')->name('gallery.show');
Route::get('/gallery/{gallery}/image/{index}', 'App\Http\Controllers\GalleryController@showImage')->name('gallery.show.image');
/**
 * Auth Guest
 */
Route::get('/login', 'App\Http\Controllers\Auth\AuthController@showLogin')->name('auth.showLogin');
Route::post('/login','App\Http\Controllers\Auth\AuthController@login')->name('auth.login');
Route::get('/register', 'App\Http\Controllers\Auth\AuthController@showRegister')->name('auth.showRegister');
Route::post('/register', 'App\Http\Controllers\Auth\AuthController@register')->name('auth.register');
/**
 * Auth User
 */
Route::middleware('auth')->group(function() {
    Route::get('/profile', 'App\Http\Controllers\Auth\AuthController@showProfile')->name('auth.showProfile');
    Route::post('/profile', 'App\Http\Controllers\Auth\AuthController@updateProfile')->name('auth.updateProfile');
    Route::get('/password', 'App\Http\Controllers\Auth\AuthController@showPassword')->name('auth.showPassword');
    Route::post('/password', 'App\Http\Controllers\Auth\AuthController@updatePassword')->name('auth.updatePassword');
    Route::post('/logout', 'App\Http\Controllers\Auth\AuthController@logout')->name('auth.logout');
});
