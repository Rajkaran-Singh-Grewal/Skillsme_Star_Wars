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
Route::get('/people','App\Http\Controllers\PeopleController@getAllCharacters')->name('getAllCharacter');
Route::post('/signin','App\Http\Controllers\UserController@signin')->middleware('web')->name('signin');
Route::post('/signup', 'App\Http\Controllers\UserController@signup')->middleware('web')->name('signup');
Route::post('/vote', 'App\Http\Controllers\VoteController@vote')->middleware('web')->name('vote');
