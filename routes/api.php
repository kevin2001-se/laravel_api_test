<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('recover_password', [AuthController::class, 'recover_password']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('user', [AuthController::class, 'user'])->middleware('auth:sanctum');

// Favorites
Route::prefix('favorites')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::controller(FavoriteController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'register');
            Route::delete('/{id}', 'delete');
        });
    });
});
