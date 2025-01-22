<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of authors with their books and reviews.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function index(Request $request)
    {
        $query = Author::with(['books', 'reviews']);

        // Optional: Search by author name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $authors = $query->paginate(10);

        return AuthorResource::collection($authors);
    }

    /**
     * Store a newly created author in storage.
     *
     * @param  \App\Http\Requests\StoreAuthorRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function store(StoreAuthorRequest $request)
    {
        $validated = $request->validated();

        $author = Author::create($validated);

        return new AuthorResource($author->load(['books', 'reviews']));
    }

    /**
     * Display the specified author with their books and reviews.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function show(Author $author)
    {
        $author->load(['books', 'reviews']);
        return new AuthorResource($author);
    }

    /**
     * Update the specified author in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthorRequest  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $validated = $request->validated();

        $author->update($validated);

        return new AuthorResource($author->load(['books', 'reviews']));
    }

    /**
     * Remove the specified author from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json(['message' => 'Author deleted successfully.'], 200);
    }
}
