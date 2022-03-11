<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies =  Movie::orderBy('created_at', 'desc')->paginate(10);
        return view('front.movies.index', compact('movies'));
    }
    public function show(Movie $movie)
    {
        $latest = Movie::orderBy('created_at', 'desc')->take(9)->get();
        return view('front.movies.show', compact('movie', 'latest'));
    }
}
