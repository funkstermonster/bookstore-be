<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;

// Route::get('/books', [BookController::class, 'index']);

// Route::get('/books/{book}', [BookController::class, 'show']);

// Route::post('/books', [BookController::class, 'store']);

// Route::put('/books/{book}', [BookController::class, 'update']);

// Route::delete('/books/{book}', [BookController::class, 'destroy']);

Route::apiResource('books', BookController::class);

