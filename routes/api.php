<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::get('/questions/{id}', [QuestionController::class, 'show']);
    Route::post('/questions', [QuestionController::class, 'store']);
    Route::put('/questions/{id}', [QuestionController::class, 'update']);
    Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);

    Route::get('get-correct-answer', [QuestionController::class, 'getCorrectAnswerCount']);
    Route::get('get-by-title', [QuestionController::class, 'getByTitle']);
    Route::get('sort-by-correct-answer', [QuestionController::class, 'sortByCorrectAnswer']);
});


