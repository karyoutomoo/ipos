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


// Route::resource('/makanan', 'FoodsController');
// Route::get('/lihatmakanan', 'FoodsController@index')->name('viewfood');
// Route::get('/tambahmakanan', 'FoodsController@tambah');
// Route::post('/tambahmakanan', 'FoodsController@create')->name('submitmakanan');

Route::group(['prefix' => 'makanan'], function(){
  Route::get('/', 'FoodsController@index');
  Route::get('buat', 'FoodsController@create_index');
  Route::post('buat', 'FoodsController@create');
});

Route::get('/pemesanan', 'OrdersController@index')->name('order');

// Route::get('/toko', 'StoresController@index')->name('store');
// Route::get('/buattoko', function(){return view('store.create');});
// Route::post('/buattoko', 'StoresController@create');
// Route::get('/daftartoko', 'StoresController@register');  
// Route::post('/daftartoko', 'StoresController@pick');

Route::prefix('toko')->group(function(){
  Route::get('/', 'StoresController@index');
  Route::get('buat', 'StoresController@create_index');
  Route::post('buat', 'StoresController@create');
  Route::get('daftar', 'StoresController@register_index');
  Route::post('daftar', 'StoresController@register');
});

Route::group(['middleware' => 'cekpenjual'], function(){
});


Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('profile')->group(function(){
  Route::get('/', 'ProfileController@index');
  Route::get('/password', 'ProfileController@password');
});

Route::resource('/status', 'StatusController');
Route::get('/status', 'StatusController@index')->name('status');