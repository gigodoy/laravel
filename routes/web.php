<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('tasks', TaskController::class)->except(['show']);
Route::get('tasks/trashed', [TaskController::class, 'trashed'])->name('tasks.trashed');
Route::post('tasks/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');
