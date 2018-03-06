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


Route::get('admin', function () {
    return view('admin_home');
});
Route::get('user', function () {
    return view('user/user_home');
});
Auth::routes();
Route::get('logout' , 'Auth\LoginController@logout')->name('out');
Route::get('allFilms','UsersController@getFilms')->name('allFilms');
Route::get('showFilm/{id}','UsersController@showFilm')->name('showFilm');
Route::get('add/{id}','UsersController@addToList')->name('add');
Route::get('showTrailer/{id}','UsersController@showTrailer')->name('showTrialer');
Route::get('showList/{user_id}','UsersController@showList')->name('showList');

Route::resource('actors', 'ActorsController');
Route::resource('films', 'FilmsController');


