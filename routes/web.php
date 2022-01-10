<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('layouts/app');
})->name('/');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/report/movies', [App\Http\Controllers\api\MovieController::class, 'exportData'])->name('report');

//Vue Router SPA Route
Route::get('home/{any?}', function () {
    return view('spa');
})->where('any','.*');
