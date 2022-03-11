<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::withCount('seasons')->orderBy('created_at', 'desc')->paginate(10);
        return view('front.series.index', compact('series'));
    }
    public function show(Serie $serie)
    {
        $latests = Serie::withCount('seasons')->orderBy('created_at', 'desc')->take(9)->get();
        return view('front.series.show', compact('serie', 'latests'));
    }
    public function seasonShow(Serie $serie, Season $season)
    {
        $latests = Season::withCount('episodes')->orderBy('created_at', 'desc')->take(9)->get();
        return view('front.series.seasons.show', compact('serie', 'season'));
    }

    public function showEpisode(Episode $episode)
    {
        $latests = Episode::orderBy('created_at', 'desc')->take(9)->get();
        return view('front.episodes.show', compact('episode'));
    }
}
