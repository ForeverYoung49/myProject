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
Route::post('/news/createComNews', 'UsersPages@createComNews')->where('id','[0-9]+')->name('add.news');
Route::post('/news/deleteComNews', 'UsersPages@deleteComNews')->name('add.news');
Route::post('/news/editComNews', 'UsersPages@editComNews')->name('add.news');

Route::get('/catalog', 'UsersPages@manga')->name('add.all_manga');
Route::get('/catalog/{id}', 'UsersPages@showManga')->where('id','[0-9]+')->name('add.manga');
Route::get('/catalog/{id}/{id_chapster}', 'UsersPages@showChapster')->where('id','[0-9]+')->name('add.manga');
Route::post('/catalog/createComManga', 'UsersPages@createComManga')->where('id','[0-9]+')->name('add.manga');
Route::post('/catalog/deleteComManga', 'UsersPages@deleteComManga')->name('add.manga');
Route::post('/catalog/editComManga', 'UsersPages@editComManga')->name('add.manga');
Route::post('/catalog/ratingManga', 'UsersPages@ratingManga')->where('id','[0-9]+')->name('add.manga');
Route::post('/catalog/addUserList', 'UsersPages@addUserList')->where('id','[0-9]+')->name('add.manga');

Route::get('/profile/{id}', 'UsersPages@userProfile')->where('id','[0-9]+')->name('add.userProfile');
Route::post('/profile/{id}', 'UsersPages@userProfile')->where('id','[0-9]+')->name('add.userProfile');
Route::post('/profile/{id}/banUser', 'UsersPages@banUser')->where('id','[0-9]+')->name('add.userProfile');

Route::get('/profile', 'UsersPages@profile')->name('add.profile');
Route::post('/profile', 'UsersPages@profile')->name('add.profile');
Route::post('/profile/unban', 'UsersPages@unbanApplication')->name('add.profile');

Route::get('/profile/edit', 'UsersPages@showEditProfile')->name('add.edit_profile');
Route::post('/profile/edit', 'UsersPages@editProfile')->name('add.edit_profile');

Route::get('/adminPanel', 'AdminPanel@showAP')->name('admin_panel.layout');
Route::get('/adminPanel/showAddManga', 'AdminPanel@showAddManga')->name('admin_panel.addManga');
Route::post('/adminPanel/addManga', 'AdminPanel@addManga')->name('admin_panel.addManga');
Route::get('/adminPanel/addManga', 'AdminPanel@addManga')->name('admin_panel.addManga');

Route::get('/adminPanel/showLastComments', 'AdminPanel@showLastComments')->name('admin_panel.lastComments');

Route::get('/adminPanel/showAddGenre', 'AdminPanel@showAddGenre')->name('admin_panel.addGenre');
Route::post('/adminPanel/addGenre', 'AdminPanel@addGenre')->name('admin_panel.addGenre');

Route::get('/adminPanel/showAddChapster', 'AdminPanel@showAddChapster')->name('admin_panel.addChapster');
Route::post('/adminPanel/addChapster', 'AdminPanel@addChapster')->name('admin_panel.addChapster');

Route::get('/adminPanel/showAddAuthor', 'AdminPanel@showAddAuthor')->name('admin_panel.addAuthor');
Route::post('/adminPanel/addAuthor', 'AdminPanel@addAuthor')->name('admin_panel.addAuthor');

Route::get('/adminPanel/showAddStatus', 'AdminPanel@showAddStatus')->name('admin_panel.addStatus');
Route::post('/adminPanel/addStatus', 'AdminPanel@addStatus')->name('admin_panel.addStatus');

Route::get('/adminPanel/showAddNews', 'AdminPanel@showAddNews')->name('admin_panel.addNews');
Route::post('/adminPanel/addNews', 'AdminPanel@addNews')->name('admin_panel.addNews');

Route::get('/adminPanel/showControlUsers', 'AdminPanel@showControlUsers')->name('admin_panel.controlUsers');
Route::post('/adminPanel/controlUsers', 'AdminPanel@controlUsers')->name('admin_panel.controlUsers');
Route::post('/adminPanel/controlUsers/unban', 'AdminPanel@unbanUser')->name('admin_panel.controlUsers');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::get('/logout','Auth\LoginController@logout');
Auth::routes();
