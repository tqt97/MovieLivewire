<?php

namespace App\Http\Livewire;

use App\Models\Genre;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class GenreIndex extends Component
{
    use WithPagination;
    protected $key = 'f7c944d484153416dadeaf04b9065872';

    public $tmdbId;
    public $title;

    public $search = '';
    public $sort = 'asc';
    public $perPage = 10;

    public $genreId;
    public $showGenreModal = false;

    protected $rules = [
        'title' => 'required',
    ];
    public function generateGenre()
    {
        $tmdb_genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=' . $this->key . '&language=en-US')->json();
        if ($tmdb_genres) {
            foreach ($tmdb_genres as $tmdb_genre) {
                foreach ($tmdb_genre as $tgenre) {
                    $genre = Genre::where('tmdb_id', $tgenre['id'])->first();
                    if (!$genre) {
                        Genre::create([
                            'tmdb_id' => $tgenre['id'],
                            'title'    => $tgenre['name'],
                            'slug'    => Str::slug($tgenre['name']),
                        ]);
                        $this->reset();
                        $this->dispatchBrowserEvent('banner-message', [
                            'style' => 'success',
                            'message' => 'Genre created successfully'
                        ]);
                    } else {
                        $this->reset();
                        $this->dispatchBrowserEvent('banner-message', [
                            'style' => 'danger',
                            'message' => 'Genre exists. Please try again'
                        ]);
                    }
                }
            }
        }
    }
    public function showEditModal($id)
    {
        $this->genreId = $id;
        $this->loadCast();
        $this->showGenreModal = true;
    }

    public function loadCast()
    {
        $genre = Genre::findOrFail($this->genreId);
        $this->title = $genre->title;
    }

    public function updateCast()
    {
        $this->validate();
        $cast = Genre::findOrFail($this->genreId);
        $cast->update([
            'title' => $this->title,
            'slug'    => Str::slug($this->title),
        ]);
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Genre updated'
        ]);
        $this->reset();
    }

    public function closeCastModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function deleteCast($id)
    {
        Genre::findOrFail($id)->delete();
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Cast deleted'
        ]);
        $this->reset();
    }

    public function resetFilters()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.genre-index', [
            'genres' => Genre::when($this->search, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%');
            })->orderBy('title', $this->sort)->paginate($this->perPage)
        ]);
    }
}
