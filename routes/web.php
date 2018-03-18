<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'GuestsController@index');

Auth::routes();

// Route::get('login', 'AdminController@error');
Route::get('/home', 'AdminController@index');
Route::get('admin-l', 'AdminController@login');

Route::group([ 'middleware'=>['auth', 'role:admin|karyawan']], function () {
//route halaman admin
	Route::resource('jenis', 'JenisController');
	Route::resource('pakets', 'PaketsController');
	Route::resource('gambars', 'ImageGalleryController');
	Route::resource('teammembers', 'TeammembersController');
	Route::resource('blogs', 'BlogsController');
	Route::resource('categoris', 'CategorisController');
	Route::resource('chat', 'GuestsController@chat');
});

Route::group([ 'middleware'=>['auth', 'role:admin']], function () {
//route halaman admin
	Route::resource('contacts', 'ContactsController');
	Route::resource('perusahaans', 'PerusahaansController');
	
});
//route halaman user
Route::resource('about', 'GuestsController@about');
Route::resource('paket', 'GuestsController@paket');
Route::resource('admin', 'GuestsController@admin');
Route::resource('gallery', 'GuestsController@gallery');
Route::resource('blog', 'GuestsController@blog');
Route::resource('post', 'GuestsController@post');
Route::resource('team', 'GuestsController@team');

Route::get('image-gallery', 'ImageGalleryController@index');
Route::post('image-gallery', 'ImageGalleryController@upload');
Route::delete('image-gallery/{id}', 'ImageGalleryController@destroy');

Route::group(['middleware'=>'cors'],function(){
	Route::get('/contoh','TestingController@api');
	Route::get('/listdata','ApiController@listdata');
});



