<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\MovieResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = CategoryResource::collection(Category::all());

        return response()->json(['genres' => $category], 200);
    }

    public function showMoviesById($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response()->json(['message' => 'No movies'], 404);
        }

        $movies = MovieResource::collection($category->movies()->paginate(2))->resource;

        return response()->json(['movies' => $movies], 200);
    }
}
