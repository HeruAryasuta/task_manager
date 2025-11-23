<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController as ApiTaskController;

// Public API routes
Route::prefix('auth')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('login-oauth', [UserController::class, 'loginOAuth']);
    Route::post('refresh', [UserController::class, 'refresh']);
});

// Protected API routes
Route::middleware('auth:api')->group(function () {
    // Auth endpoints
    Route::prefix('auth')->group(function () {
        Route::get('user', [UserController::class, 'user']);
        Route::post('logout', [UserController::class, 'logout']);
    });
    
    Route::apiResource('tasks', ApiTaskController::class)->names([
        'index' => 'api.tasks.index',
        'store' => 'api.tasks.store',
        'show' => 'api.tasks.show',
        'update' => 'api.tasks.update',
        'destroy' => 'api.tasks.destroy',
    ]);
});