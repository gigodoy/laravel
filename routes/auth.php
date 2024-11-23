<?php

// routes/auth.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;

// Ruta de login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

// Ruta para procesar el login
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Ruta de registro
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

// Ruta para procesar el registro
Route::post('/register', [RegisteredUserController::class, 'store']);

// Confirmación de correo
Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification.notice');

// Ruta para confirmar el correo
Route::get('/verify-email/{id}/{hash}', [EmailVerificationPromptController::class, 'verify'])
    ->middleware('auth')
    ->name('verification.verify');

// Recuperar contraseña
Route::get('/forgot-password', [NewPasswordController::class, 'create'])
    ->name('password.request');

// Enviar enlace para recuperar la contraseña
Route::post('/forgot-password', [NewPasswordController::class, 'store'])
    ->name('password.email');

// Restablecer la contraseña
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

// Procesar restablecimiento de la contraseña
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.update');

// Confirmación de contraseña
Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth')
    ->name('password.confirm');

// Procesar confirmación de contraseña
Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth');
