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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/job',  [App\Http\Controllers\JobController::class, 'index'])->name('job');
Route::get('/job-page/{id?}',  [App\Http\Controllers\JobController::class, 'pagination'])->name('job-page');
Route::get('/job-search/{keyword?}/{location?}',  [App\Http\Controllers\JobController::class, 'search'])->name('job-search');
