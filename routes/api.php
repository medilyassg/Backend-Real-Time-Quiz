<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizSessionController;
use App\Http\Controllers\RegistreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\WaitingRoomController;



Route::middleware(['web', 'api'])->group(function () {

    Route::prefix('v1')->group(function () {
        // get all data quiz for host and player without auth
        Route::post('allquiz', [QuizController::class, 'allQuiz']);

        Route::group(['prefix' => 'auth'], function () {

            Route::post('login', [LoginController::class, 'login']);

            Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
        });

        // Room Session
        Route::post('registre', [RegistreController::class, 'registre']);
        Route::post('/create-room', [WaitingRoomController::class, 'createRoom']);
        Route::post('/room-exists', [WaitingRoomController::class, 'roomExists']);
        Route::post('/join-room', [WaitingRoomController::class, 'joinRoom']);
        Route::post('/get-players', [WaitingRoomController::class, 'getPlayers']);
        Route::post('/start-quiz', [WaitingRoomController::class, 'startQuiz']);

        //Quiz Session
        Route::post('/get-time', [QuizSessionController::class, 'getDataQuizSession']);
        Route::post('/change-time', [QuizSessionController::class, 'changeTime']);
        Route::post('/change-index', [QuizSessionController::class, 'changeIndex']);
        Route::post('/get-score-of-player', [QuizSessionController::class, 'getScoreOfplayer']);
        Route::post('/change-score', [QuizSessionController::class, 'changeScore']);
        Route::post('/get-first-time', [QuizSessionController::class, 'getFirstTime']);
        Route::post('/change-first-time', [QuizSessionController::class, 'changeFirstTime']);
        Route::delete('/delete-cache', [QuizSessionController::class, 'deleteCache']);

        Route::middleware(['auth:sanctum'])->group(function () {
            // ###             All Route Application             ### //
            Route::get('user', [LoginController::class, 'user']);

            // Quiz
            Route::prefix('quizzes')->group(function () {
                Route::get('/', [QuizController::class, 'index']);
                Route::post('/', [QuizController::class, 'store']);
                Route::put('{quiz}', [QuizController::class, 'update']);
                Route::delete('{quiz}', [QuizController::class, 'destroy']);
            });

            // Question
            Route::prefix('question')->group(function () {
                Route::get('/', [QuestionController::class, 'index']);
                Route::get('/{question}', [QuestionController::class, 'show']);
                Route::post('/', [QuestionController::class, 'store']);
                Route::put('{question}', [QuestionController::class, 'update']);
                Route::delete('{question}', [QuestionController::class, 'destroy']);
            });

            // Option
            Route::prefix('options')->group(function () {
                Route::get('/', [OptionController::class, 'index']);
                Route::get('/{id}', [OptionController::class, 'show']);
                Route::post('/', [OptionController::class, 'store']);
                Route::put('/{id}', [OptionController::class, 'update']);
                Route::delete('/{id}', [OptionController::class, 'destroy']);
            });

        });
    });
});
