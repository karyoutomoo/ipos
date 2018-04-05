<?php

use Illuminate\Http\Request;
use App\Food;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
** Basic Routes for RESTful service:
** Route::get($uri, $callback);
** Route::post($uri, $callback);
** Route::put($uri, $callback);
** Route::delete($uri, $callback);
**/

Route::get('foods', 'FoodsController@index');

Route::get('foods/{food}', 'FoodsController@show');

Route::post('foods', 'FoodsController@store');

Route::put('foods/{food}', 'FoodsController@update');

Route::delete('foods/{food}', 'FoodsController@delete');


