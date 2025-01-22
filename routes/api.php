<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategorySearchController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;

// Versioned API routes
Route::prefix('v1')->group(function () {
    Route::apiResource('books', BookController::class);
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('reviews', ReviewController::class);
    Route::get('search-by-category', [CategorySearchController::class, '__invoke']);

    Route::get('test', function () {
        return response()->json(['message' => 'API is working!'], 200);
    });
});
