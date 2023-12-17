<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\RegistreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;



Route::middleware(['web', 'api'])->group(function () {

    Route::prefix('v1')->group(function () {
        Route::group(['prefix' => 'auth'], function () {

            Route::post('login', [LoginController::class, 'login']);

            Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
        });

        Route::post('registre', [RegistreController::class, 'registre']);
        Route::middleware(['auth:sanctum'])->group(function () {
            // All Route Application
            Route::get('user', [LoginController::class, 'user']);

            Route::prefix('quizzes')->group(function () {
                Route::get('/', [QuizController::class, 'index']);
                Route::post('/', [QuizController::class, 'store']);
                Route::put('{quiz}', [QuizController::class, 'update']);
                Route::delete('{quiz}', [QuizController::class, 'destroy']);
            });
        });
    });
});
