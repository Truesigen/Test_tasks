<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = MovieResource::collection(Movie::paginate(3))->resource;

        return response()->json(['movies' => $movies], 200);
    }

    public function show($id)
    {
        $movie = new MovieResource(Movie::find($id));

        return response()->json(['movie' => $movie], 200);
    }
}
