<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection; // Add this import

class ReviewController extends Controller
{
    /**
     * Display a listing of reviews with their associated reviewable entities.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
     
    public function index(): AnonymousResourceCollection
    {
        $reviews = Review::with(['reviewable'])->paginate(10);
        return ReviewResource::collection($reviews);
    }

    /**
     * Store a newly created review in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \App\Http\Resources\ReviewResource
     */
     
    public function store(StoreReviewRequest $request): ReviewResource
    {
        $validated = $request->validated();

        $review = Review::create($validated);

        return new ReviewResource($review->load(['reviewable']));
    }

    /**
     * Display the specified review with its associated reviewable entity.
     *
     * @param  \App\Models\Review  $review
     * @return \App\Http\Resources\ReviewResource
     */
     
    public function show(Review $review): ReviewResource
    {
        $review->load(['reviewable']);
        return new ReviewResource($review);
    }

    /**
     * Update the specified review in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \App\Http\Resources\ReviewResource
     */
     
    public function update(UpdateReviewRequest $request, Review $review): ReviewResource
    {
        $validated = $request->validated();

        $review->update($validated);

        return new ReviewResource($review->load(['reviewable']));
    }

    /**
     * Remove the specified review from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function destroy(Review $review): \Illuminate\Http\JsonResponse
    {
        $review->delete();
        return response()->json(['message' => 'Review deleted successfully.'], 200);
    }
}
