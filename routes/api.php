<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//User

Route::prefix('/user')->group(function() {
    Route::post('/login', 'App\Http\Controllers\api\LoginController@login');
    Route::middleware('auth:api')->group(function() {
        Route::get('/index', 'App\Http\Controllers\api\UserController@all');
        Route::get('/current', 'App\Http\Controllers\api\UserController@current');
    });
});

Route::prefix('/movies')->middleware('auth:api')->group(function() {
    Route::get('/omdb', 'App\Http\Controllers\api\MovieController@omdb');
    Route::get('/omdbDetail', 'App\Http\Controllers\api\MovieController@omdbDetail');
    Route::get('/', 'App\Http\Controllers\api\MovieController@index');
    Route::post('create-movie', 'App\Http\Controllers\api\MovieController@store');
    Route::get('{movie:slug}', 'App\Http\Controllers\api\MovieController@show');
    Route::delete('delete/{id}', 'App\Http\Controllers\api\MovieController@delete');
});

Route::prefix('category')->middleware('auth:api')->group(function () {
    Route::get('/', 'App\Http\Controllers\api\MovieController@indexCategory');
});

Route::prefix('gis')->middleware('auth:api')->group(function () {
    Route::get('/', 'App\Http\Controllers\api\GisController@index');
    Route::post('create-pinpoint', 'App\Http\Controllers\api\GisController@store');
    Route::post('update-pinpoint', 'App\Http\Controllers\api\GisController@update');
    Route::delete('delete/{id}', 'App\Http\Controllers\api\GisController@delete');
});

Route::prefix('covid')->middleware('auth:api')->group(function () {
    Route::get('/today', 'App\Http\Controllers\api\CovidController@getLatest');
    Route::get('/last-month/{days}', 'App\Http\Controllers\api\CovidController@getLastMonth');
});
