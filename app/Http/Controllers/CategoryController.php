<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        return new CategoryResource($category);
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $category->update($validated);

        return new CategoryResource($category);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
     
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully.'], 200);
    }
}
