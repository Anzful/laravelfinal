<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Notifications\NewBookNotification;
use App\Models\User;

class BookController extends Controller
{
    /**
     * Display a listing of books with optional search and filtering.
     */
    public function index(Request $request)
    {
        $query = Book::with(['author', 'categories', 'reviews']);

        // Search by title or author name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                  ->orWhereHas('author', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $categoryId = $request->input('category_id');
            $query->whereHas('categories', function($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        // Additional filters can be added here

        $books = $query->paginate(10);

        return BookResource::collection($books);
    }

    /**
     * Store a newly created book in storage and notify users.
     */
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();

        $book = Book::create([
            'author_id' => $validated['author_id'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null
        ]);

        $book->categories()->attach($validated['categories']);

        // Notify all users about the new book
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NewBookNotification($book));
        }

        return new BookResource($book->load(['author', 'categories', 'reviews']));
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        $book->load(['author', 'categories', 'reviews']);
        return new BookResource($book);
    }

    /**
     * Update the specified book in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validated = $request->validated();

        $book->update($validated);

        if (isset($validated['categories'])) {
            $book->categories()->sync($validated['categories']);
        }

        return new BookResource($book->load(['author', 'categories', 'reviews']));
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully.'], 200);
    }
}
