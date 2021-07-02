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

// Route::get('/detail', function () {
//     return view('dashboard.v_detail-todo');
// });
Route::get('/', 								[App\Http\Controllers\PageController::class, 'index'])->name('home');
Route::get('/about', 							[App\Http\Controllers\PageController::class, 'about'])->name('about');

Auth::routes();

Route::get('/dashboard',						[App\Http\Controllers\TodolistController::class, 'index'])->name('dashboard');
Route::get('/dashboard/create-todo', 			[App\Http\Controllers\TodolistController::class, 'create'])->name('create-todo');
Route::post('/dashboard/create-todo',			[App\Http\Controllers\TodolistController::class, 'store'])->name('create-todo.store');
Route::get('/dashboard/detail-todo/{todolist}', [App\Http\Controllers\TodolistController::class, 'show'])->name('detail-todo');
Route::get('/dashboard/delete-todo/{todolist}', [App\Http\Controllers\TodolistController::class, 'destroy'])->name('delete-todo');
Route::get('/dashboard/edit-todo/{todolist}', 	[App\Http\Controllers\TodolistController::class, 'edit'])->name('edit-todo');
Route::put('/dashboard/edit-todo/{todolist}', [App\Http\Controllers\TodolistController::class, 'update'])->name('update-todo');