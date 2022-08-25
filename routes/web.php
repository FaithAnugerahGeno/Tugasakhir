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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/job-search',  [App\Http\Controllers\JobController::class, 'index'])->name('job-search');

Route::get('/zoom', [\App\Http\Controllers\ZoomController::class, 'index'])->name('zoom');
Route::get('/zoom/create', [\App\Http\Controllers\ZoomController::class, 'create'])->name('zoom/create');
Route::post('/zoom/save', [\App\Http\Controllers\ZoomController::class, 'save'])->name('zoom/save');

Route::get('/identitas', [\App\Http\Controllers\IdentitasController::class, 'index'])->name('identitas');

Route::get('/kurikulum', [\App\Http\Controllers\KurikulumController::class, 'index'])->name('kurikulum');
Route::get('/kurikulum/add', [\App\Http\Controllers\KurikulumController::class, 'add'])->name('kurikulum/add');
Route::post('/kurikulum/save', [\App\Http\Controllers\KurikulumController::class, 'store'])->name('kurikulum/save');
Route::delete('/kurikulum/delete/{id}', [\App\Http\Controllers\KurikulumController::class, 'destroy'])->name('kurikulum/delete');
