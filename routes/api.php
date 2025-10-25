<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login']);
Route::get('/users', [UserController::class, 'users']);
Route::get('/users/search/{query}', [UserController::class, 'usersSearch']);

Route::get('/books', [BookController::class, 'books']);
Route::get('/books/search/{query}', [BookController::class, 'booksSearch']);
Route::get('/books/category/{category}', [BookController::class, 'booksByCategory']);
Route::get('/books/top-rated/{limit}', [BookController::class, 'topRatedBooks']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/users/{id}', [UserController::class, 'user']);
    Route::post('/users/store', [UserController::class, 'store']);
    Route::put('/users/update/{id}', [UserController::class, 'update']);
    Route::delete('/users/delete/{id}', [UserController::class, 'delete']);

    Route::get('/books/{id}', [BookController::class, 'book']);
    Route::post('/books/store', [BookController::class, 'store']);
    Route::put('/books/update/{id}', [BookController::class, 'update']);
    Route::delete('/books/delete/{id}', [BookController::class, 'delete']);
});
