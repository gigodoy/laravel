<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\AuthController;

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('tasks', TaskController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::post('login', [AuthController::class, 'login']);

});
