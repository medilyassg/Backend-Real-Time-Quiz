<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\RegistreController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // Authentication Routes
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
    });

    // Registration Route
    Route::post('registre', [RegistreController::class, 'registre']);

    // Authenticated Routes
    Route::middleware(['auth:sanctum'])->group(function () {
        // User Route
        Route::get('user', [LoginController::class, 'user']);

        // Quiz Routes
        Route::prefix('quizzes')->group(function () {
            Route::get('/', [QuizController::class, 'index']);
            Route::post('/', [QuizController::class, 'store']);
            Route::put('{quiz}', [QuizController::class, 'update']);
            Route::delete('{quiz}', [QuizController::class, 'destroy']);
        });
    });
});
