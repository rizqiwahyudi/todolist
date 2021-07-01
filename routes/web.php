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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\PagesController::class, 'about'])->name('about');

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\TodolistsController::class, 'index'])->name('dashboard');
