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
    return view('user_home');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout' , 'Auth\LoginController@logout')->name('out');

Route::resource('actors', 'ActorsController');
Route::resource('films', 'FilmsController');


