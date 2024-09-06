<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryMovie;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::query()->with(['categories'])->get();

        return view('admin.movie.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.movie.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MovieService $service)
    {
        $validation = Validator::make($request->all(), ['name' => 'required|string', 'category_id' => 'required|array', 'preview_image' => 'nullable|image']);

        if ($validation->fails()) {
            return back()->withErrors($validation->errors()->all());
        }

        $data = $validation->validated();

        $data['preview_image'] = $service->handleImage($request->file('preview_image'));
        //try-catch
        Movie::create($data)->categories()->attach($data['category_id']);

        return redirect()->route('movies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::find($id);
        $categories = Category::all();
        $tags = CategoryMovie::where('movie_id', $id)->get();

        return view('admin.movie.edit', compact('movie', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, MovieService $service)
    {
        $validation = Validator::make($request->all(), ['name' => 'string', 'category_id' => 'array', 'preview_image' => 'image']);

        if ($validation->fails()) {
            return back()->withErrors($validation->errors()->all());
        }

        $data = $validation->validated();

        $service->handleUpdateMovie($id, $data);

        return redirect()->route('movies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        $movie->categories()->detach();

        return redirect()->route('movies.index');
    }

    public function changeStatusById($id)
    {
        $movie = Movie::find($id);

        $movie->is_published = ! $movie->is_published;

        $movie->save();

        return redirect()->route('movies.index');
    }
}
