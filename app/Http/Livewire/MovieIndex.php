<?php

namespace App\Http\Livewire;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Tag;
use App\Models\TrailerUrl;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class MovieIndex extends Component
{
    protected $key = 'f7c944d484153416dadeaf04b9065872';
    use WithPagination;

    public $title, $runtime, $lang, $video_format, $rating, $poster_path, $backdrop_path, $overview, $release_date, $is_public, $tmdb_id, $slug, $movie_id, $visits;

    public $search = '';
    public $sortColumn = 'title';
    public $sort = 'asc';
    public $sortDirection = 'asc';
    public $perPage = 10; 

    public $movie;
    public $trailerName, $embedHtml;

    public $showMovieModal = false;
    public $showTrailer = false;
    public $showMovieDetailModal = false;

    protected $listeners = [
        'tagAdded' => 'tagAdded',
        'tagDetached' => 'tagDetached',
        'castAdded' => 'castAdded',
        'castDetached' => 'castDetached',
        'noCastSelected' => 'noCastSelected',
    ];
    protected $rules = [
        'title' => 'required',
        'poster_path' => 'required',
        'runtime' => 'required',
        'lang' => 'required',
        'video_format' => 'required',
        'rating' => 'required',
        'backdrop_path' => 'required',
        'overview' => 'required',
        'is_public' => 'required'
    ];
    public function showMovieModal()
    {
        $this->showMovieModal = true;
    }

    public function generateMovie()
    {
        $movie = movie::where('tmdb_id', $this->tmdb_id)->exists();
        if ($movie) {
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Movie already exists']);
            return;
        }
        $url = 'https://api.themoviedb.org/3/movie/' . $this->tmdb_id . '?api_key=' . $this->key . '&language=en-US';
        $apiMovie = Http::get($url);

        if ($apiMovie->successful()) {
            if (!$this->tmdb_id) {
                $this->dispatchBrowserEvent('banner-message', [
                    'style' => 'danger',
                    'message' => 'Movie ID is empty. Please enter a valid Season ID.'
                ]);
            } else {
                if (!is_numeric($this->tmdb_id)) {
                    $this->dispatchBrowserEvent('banner-message', [
                        'style' => 'danger',
                        'message' => 'Movie ID is a number. Please try again'
                    ]);
                } else {
                    $newMovie = $apiMovie->json();
                    $created_movie =   Movie::create([
                        'tmdb_id' => $newMovie['id'],
                        'title' => $newMovie['title'],
                        'slug'  => Str::slug($newMovie['title']),
                        'runtime' => $newMovie['runtime'],
                        'rating' => $newMovie['vote_average'],
                        'release_date' => $newMovie['release_date'],
                        'lang' => $newMovie['original_language'],
                        'video_format' => 'HD',
                        'is_public' => false,
                        'overview' => $newMovie['overview'],
                        'poster_path' => $newMovie['poster_path'],
                        'backdrop_path' => $newMovie['backdrop_path']
                    ]);
                    $tmdb_genres = $newMovie['genres'];
                    $tmdb_genres_ids = collect($tmdb_genres)->pluck('id');
                    $genres = Genre::whereIn('tmdb_id', $tmdb_genres_ids)->get();
                    $created_movie->genres()->attach($genres);
                    $this->reset('tmdb_id');

                    $this->dispatchBrowserEvent('banner-message', [
                        'style' => 'success',
                        'message' => 'Movie created successfully'
                    ]);
                }
            }
        } else {
            $this->reset();
            $this->dispatchBrowserEvent('banner-message', [
                'style' => 'danger',
                'message' => 'Api not exists. Please try again'
            ]);
        }
    }
    public function showEditModal($id)
    {
        $this->movie = Movie::findOrFail($id);
        $this->loadMovie();
        $this->showMovieModal = true;
    }
    public function loadMovie()
    {
        $this->title = $this->movie->title;
        $this->runtime = $this->movie->runtime;
        $this->lang = $this->movie->lang;
        $this->video_format = $this->movie->video_format;
        $this->rating = $this->movie->rating;
        $this->poster_path = $this->movie->poster_path;
        $this->backdrop_path = $this->movie->backdrop_path;
        $this->overview = $this->movie->overview;
        $this->is_public = $this->movie->is_public;
    }
    public function updateMovie()
    {
        $this->validate();
        $this->movie->update([
            'title' => $this->title,
            'runtime' => $this->runtime,
            'lang' => $this->lang,
            'video_format' => $this->video_format,
            'rating' => $this->rating,
            'poster_path' => $this->poster_path,
            'backdrop_path' => $this->backdrop_path,
            'overview' => $this->overview,
            'is_public' => $this->is_public,
            'slug' => Str::slug($this->title)
        ]);
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Movie updated successfully'
        ]);
        $this->reset();
    }
    public function deleteMovie($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Movie delete successfully'
        ]);
        $this->reset();
    }
    public function closeMovieModal()
    {
        $this->showMovieModal = false;
        $this->reset();
    }
    public function showTrailerModal($movieId)
    {
        $this->movie = Movie::findOrFail($movieId);
        $this->showTrailer = true;
    }

    public function addTrailer()
    {
        $this->movie->trailers()->create([
            'name' => $this->trailerName,
            'embed_html' => $this->embedHtml
        ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Trailer added']);
        $this->reset();
    }

    public function deleteTrailer($id)
    {
        $trailer = TrailerUrl::findOrFail($id);
        $trailer->delete();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Trailer deleted']);
        $this->reset();
    }
    public function closeTrailerModal()
    {
        $this->showTrailer = false;
        $this->reset();
    }

    public function showMovieDetail($id)
    {
        $this->movie = Movie::findOrFail($id);
        $this->loadMovie();
        $this->showMovieDetailModal = true;
    }

    public function tagAdded()
    {
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Tag added']);
        $this->reset();
    }
    public function tagDetached()
    {
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Tag detached']);
        $this->reset();
    }
    public function castAdded()
    {
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Cast added']);
        $this->reset();
    }
    public function castDetached()
    {
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Cast detached']);
        $this->reset();
    }
    public function noCastSelected()
    {
        $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'No cast selected']);
        $this->reset();
    }
    public function sortByColumn($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortColumn = $column;
    }
    public function resetFilters()
    {
        $this->reset();
    }
    public function render()
    {
        return view('livewire.movie-index', [
            'movies' => Movie::when($this->search, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
}
