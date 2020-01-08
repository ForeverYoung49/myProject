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

Route::get('/', 'UsersPages@index')->name('add.index');

Route::get('/news', 'UsersPages@news')->name('add.all_news');
Route::get('/news/{id}', 'UsersPages@showNews')->where('id','[0-9]+')->name('add.news');

Route::get('/catalog', 'UsersPages@manga')->name('add.all_manga');
Route::get('/catalog/{id}', 'UsersPages@showManga')->where('id','[0-9]+')->name('add.manga');

Route::get('/profile', 'UsersPages@profile')->name('add.profile');


Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::get('/logout','Auth\LoginController@logout');
Auth::routes();
