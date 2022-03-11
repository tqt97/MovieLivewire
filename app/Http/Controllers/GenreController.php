<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function show(Genre $genre)
    {
        $movies = $genre->movies()->paginate(10);
        return view('front.genres.show', compact('genre', 'movies'));
    }
}
