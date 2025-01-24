<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection; // Add this import

class CategorySearchController extends Controller
{
    /**
     * Handle the incoming request to search books by category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id'
        ], [
            'category_id.required' => 'The category_id field is required.',
            'category_id.exists' => 'The specified category does not exist.'
        ]);

        $categoryId = $request->input('category_id');

        $books = Book::with(['author', 'categories', 'reviews'])
                     ->whereHas('categories', function($q) use ($categoryId) {
                         $q->where('categories.id', $categoryId);
                     })
                     ->get();

        return BookResource::collection($books);
    }
}
