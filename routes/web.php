<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/library', function() {
    $books = App\Models\Book::with('author')->get();
    return view('library', compact('books'));
});

Route::get('/authors', function() {
    $authors = App\Models\Author::with('books')->get();
    return view('authors.index', compact('authors'));
})->name('authors.index');

Route::get('/categories', function() {
    $categories = App\Models\Category::with('books')->get();
    return view('categories.index', compact('categories'));
})->name('categories.index');

// Define root URL to use HomeController
Route::get('/', [HomeController::class, 'index']);
