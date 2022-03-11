<?php

namespace App\Http\Controllers;

use App\Models\Cast;

class CastController extends Controller
{
    public function index()
    {
        $casts = Cast::orderBy('created_at', 'desc')->paginate(10);
        return view('front.casts.index', compact('casts'));
    }
    public function show(Cast $cast)
    {
        return view('front.casts.show', compact('cast'));
    }
}
