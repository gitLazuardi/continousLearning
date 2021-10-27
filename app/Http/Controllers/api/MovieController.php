<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Http\Resources\Movies;
use App\Helpers\ApiHandler;
class MovieController extends Controller
{
    public function omdb(Request $request) {
        $url = "http://www.omdbapi.com/?apikey=7b86ede0&s=".urlencode($request['s']); 
        $api = new ApiHandler();
        return $api->getPublic($url);
    }
    public function omdbDetail(Request $request) {
        $url = "http://www.omdbapi.com/?apikey=7b86ede0&i=".$request['i'];
        $api = new ApiHandler();
        return $api->getPublic($url);
    }

    public function index()
    {
        $movies = Movie::with('category')->latest()->get();
        return Movies::collection($movies);
    }

    public function indexCategory()
    {
        return response()->json(Category::all());
    }

    public function store()
    {
        request()->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        
        if (request('id')) {
            $movie = Movie::where('id', '=', request('id'));
            $movie->update([
                'category_id' => request('category_id'),
                'title' => request('title'),
                'description' => request('description'),
            ]);
        } else {
            $movie = Movie::create([
                'category_id' => request('category_id'),
                'title' => request('title'),
                'slug' => \Str::slug(request('title')),
                'description' => request('description'),
            ]);
        }
        return response()->json([
            'message' => 'Movie saved',
            'movie' => $movie,
        ]);
    }

    public function show(Movie $movie)
    {
        return $movie;
    }

    public function delete($id)
    {
        $movie = Movie::where('id', '=', $id);
        $movie->delete();
    }
}
