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
    Route::get('/index', 'App\Http\Controllers\api\UserController@all')->middleware('auth:api');
    Route::get('/current', 'App\Http\Controllers\api\UserController@current')->middleware('auth:api');
});

Route::prefix('/movies')->group(function() {
    Route::get('/omdb', 'App\Http\Controllers\api\MovieController@omdb')->middleware('auth:api');
    Route::get('/omdbDetail', 'App\Http\Controllers\api\MovieController@omdbDetail')->middleware('auth:api');
    Route::get('/', 'App\Http\Controllers\api\MovieController@index')->middleware('auth:api');
    Route::post('create-movie', 'App\Http\Controllers\api\MovieController@store')->middleware('auth:api');
    Route::get('{movie:slug}', 'App\Http\Controllers\api\MovieController@show')->middleware('auth:api');
    Route::delete('delete/{id}', 'App\Http\Controllers\api\MovieController@delete')->middleware('auth:api');
});

Route::prefix('category')->group(function () {
    Route::get('/', 'App\Http\Controllers\api\MovieController@indexCategory')->middleware('auth:api');
});

Route::prefix('gis')->group(function () {
    Route::get('/', 'App\Http\Controllers\api\GisController@index')->middleware('auth:api');
    Route::post('create-pinpoint', 'App\Http\Controllers\api\GisController@store')->middleware('auth:api');
    Route::post('update-pinpoint', 'App\Http\Controllers\api\GisController@update')->middleware('auth:api');
    Route::delete('delete/{id}', 'App\Http\Controllers\api\GisController@delete')->middleware('auth:api');
});

Route::prefix('covid')->group(function () {
    Route::get('/', 'App\Http\Controllers\api\CovidController@getLatest')->middleware('auth:api');
    Route::get('/last-month/{days}', 'App\Http\Controllers\api\CovidController@getLastMonth');
});
