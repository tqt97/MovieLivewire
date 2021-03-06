<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use App\Models\Serie;
use App\Models\User;

// use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->take(10)->get();
        $movies = Movie::orderBy('created_at', 'desc')->take(10)->get();
        $series = Serie::withCount('seasons')->orderBy('created_at', 'desc')->take(10)->get();
        $episodes = Episode::orderBy('created_at', 'desc')->take(10)->get();
        return view('welcome', compact('movies', 'series', 'episodes'));
    }
}
