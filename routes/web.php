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

Route::get('403', function(){return view('403'); });

Route::prefix('profile')->group(function(){
  Route::get('/', 'ProfileController@index');
  Route::put('/', 'ProfileController@left');
  Route::get('password', 'ProfileController@password_index');
  Route::post('password', 'ProfileController@password');
});

Route::prefix('toko')->group(function(){
  Route::get('/', 'StoresController@index');
  Route::middleware('cekpenjual')->group(function(){
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
});

Route::prefix('makanan')->group(function(){
  Route::get('/', 'MenusController@index');
  Route::middleware('cekpenjual')->group(function(){
    Route::get('buat', 'MenusController@create_index');
    Route::post('buat', 'MenusController@create');
    Route::get('edit/{menu}', 'MenusController@edit_index');
    Route::post('edit/{menu}', 'MenusController@edit');
    Route::post('toggle', 'MenusController@toggle' );
  });
});

// Order page
Route::prefix('pemesanan')->group(function(){
  Route::get('/', 'OrdersController@index');
  Route::post('/', 'OrdersController@store');
  Route::get('status', 'OrdersController@status_index');
  Route::post('status/ask', 'OrdersController@ask_order');
  Route::post('status/cancel', 'OrdersController@cancel_order');
  Route::middleware('cekkasir')->group(function(){
    Route::get('kasir', 'OrdersController@cashier_index');
    Route::post('kasir/pay', 'OrdersController@pay_order');
  });
  Route::middleware('cekpenjual')->group(function(){
    Route::get('toko', 'OrdersController@seller_index');
    Route::post('toko/accept', 'OrdersController@accept_order');
    Route::post('toko/close', 'OrdersController@close_order');
  });
});

Route::prefix('ulasan')->group(function(){
  Route::get('/', 'ReviewsController@index');
  Route::post('buat', 'ReviewsController@store');
});

