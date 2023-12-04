<?php

use App\Http\Controllers\RegistreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;



Route::middleware(['web', 'api'])->group(function () {

    Route::prefix('v1')->group(function () {
        Route::group(['prefix' => 'auth'], function () {

            Route::post('login',[LoginController::class,'login']);
            Route::post('registre',[RegistreController::class,'registre']);
            Route::post('logout',[LoginController::class,'logout'])->middleware('auth:sanctum');
        });

        Route::middleware(['auth:sanctum'])->group(function () {
            // All Route Application
            Route::get('user',[LoginController::class,'user']);

            
        });

    });
});


