<?php

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

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::resource('leagues', 'LeaguesController');
Route::resource('games', 'GamesController');


Route::resource('teams', 'TeamsController');


Route::post('/leagues/{league}/teams', 'TeamsController@store');

Route::post('/leagueReset', 'LeaguesController@reset');







Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
