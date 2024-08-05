<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('quizzes', QuizController::class);

// Routes for taking and submitting quizzes
Route::get('/quizzes/{quiz}/take', [QuizController::class, 'showQuiz'])->name('quizzes.take');
Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submitQuiz'])->name('quizzes.submit');

// Routes for managing questions within a quiz
Route::get('/quizzes/{quiz}/questions', [QuizController::class, 'indexQuestions'])->name('quizzes.questions.index');
Route::get('/quizzes/{quiz}/questions/create', [QuizController::class, 'createQuestion'])->name('quizzes.questions.create');
Route::post('/quizzes/{quiz}/questions', [QuizController::class, 'storeQuestion'])->name('quizzes.questions.store');
Route::get('/quizzes/{quiz}/questions/{question}/edit', [QuizController::class, 'editQuestion'])->name('quizzes.questions.edit');
Route::put('/quizzes/{quiz}/questions/{question}', [QuizController::class, 'updateQuestion'])->name('quizzes.questions.update');
