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
Auth::routes();

Route::get('/', function () { return view('welcome'); });
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('profile')->group(function(){
  Route::get('/', 'ProfileController@index');
  Route::put('/', 'ProfileController@left');
  Route::get('password', 'ProfileController@password_index');
  Route::post('password', 'ProfileController@password');
});

Route::prefix('toko')->group(function(){
  Route::get('/', 'StoresController@index');
  Route::get('buat', 'StoresController@create_index');
  Route::post('buat', 'StoresController@create');
  Route::get('daftar', 'StoresController@register_index');
  Route::post('daftar', 'StoresController@register');
  Route::get('edit/{store}', 'StoresController@edit_index');
  Route::put('edit/{store}', 'StoresController@edit');
  Route::delete('delete', 'StoresController@delete');
  Route::put('toggle','StoresController@toggle');
  Route::put('register', 'StoresController@register_button');
});

Route::prefix('makanan')->group(function(){
  Route::get('/', 'MenusController@index');
  Route::get('buat', 'MenusController@create_index');
  Route::post('buat', 'MenusController@create');
  Route::get('edit/{menu}', 'MenusController@edit_index');
  Route::post('edit/{menu}', 'MenusController@edit');
});

// Order page
Route::prefix('pemesanan')->group(function(){
  Route::get('/', 'OrdersController@index');
  Route::post('/', 'OrdersController@store');
  Route::get('status', 'OrdersController@status_index');
});

Route::group(['middleware' => 'cekpenjual'], function(){
});

