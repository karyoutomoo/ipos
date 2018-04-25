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

// Route::resource('makanan', 'FoodsController');
Route::get('/viewfood', 'FoodsController@boot')->name('viewfood');

Route::get('/order', 'OrdersController@index')->name('order');

Route::get('/store', 'StoresController@index')->name('store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/settings', 'AdminController@index');

Route::get('/admin/password', 'AdminController@password');

Route::get('/status', function(){ return view('status.index'); })->name('status');