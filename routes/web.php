<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

// Página principal (home)
Route::get('/', function () {
    return view('welcome');
});

// Rutas para autenticación (registro, inicio de sesión, etc.)
Auth::routes();

// Ruta para el dashboard, donde se verán las tareas del usuario autenticado
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rutas para gestionar las tareas
Route::resource('tasks', TaskController::class)->except(['show']);

// Ruta para mostrar las tareas eliminadas (borrado suave)
Route::get('tasks/trashed', [TaskController::class, 'trashed'])->name('tasks.trashed');

// Ruta para restaurar tareas eliminadas (borrado suave)
Route::post('tasks/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore');

Route::get('/home', function () {
    return view('home'); // Asegúrate de que la vista es 'home'
})->middleware('auth')->name('home');
