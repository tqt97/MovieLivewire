<?php

namespace App\Http\Livewire;

use App\Models\Serie;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class SerieIndex extends Component
{
    use WithPagination;
    protected $key = 'f7c944d484153416dadeaf04b9065872';

    public $tmdbId;
    public $name, $poster_path, $created_year;
    public $serieId;
    public $showSerieModal = false;

    public $search = '';
    public $sort = 'asc';
    public $perPage = 10;

    protected $rules = [
        'name' => 'required',
        'poster_path' => 'required',
        'created_year' => 'required',
    ];

    public function generateSerie()
    {
        $serie = Serie::where('tmdb_id', $this->tmdbId)->first();
        if ($serie) {
            $this->dispatchBrowserEvent('banner-message', [
                'style' => 'danger',
                'message' => 'Serie already exists'
            ]);
            return;
        }
        $apiSerie = Http::get('https://api.themoviedb.org/3/tv/' . $this->tmdbId . '?api_key=' . $this->key . '&language=en-US');
        if ($apiSerie->successful()) {

            if (!$this->tmdbId) {
                $this->dispatchBrowserEvent('banner-message', [
                    'style' => 'danger',
                    'message' => 'Serie ID is empty. Please enter a valid Serie ID.'
                ]);
            } else {
                if (!is_numeric($this->tmdbId)) {
                    $this->dispatchBrowserEvent('banner-message', [
                        'style' => 'danger',
                        'message' => 'Serie ID is a number. Please try again'
                    ]);
                } else {
                    // if (count($newSerie) > 3) {
                    $newSerie = $apiSerie->json();
                    // if (!$cast) {
                    Serie::create([
                        'tmdb_id' => $newSerie['id'],
                        'name'    => $newSerie['name'],
                        'slug'    => Str::slug($newSerie['name']),
                        'poster_path' => $newSerie['poster_path'],
                        'created_year' => $newSerie['first_air_date']
                    ]);
                    $this->reset();
                    $this->dispatchBrowserEvent('banner-message', [
                        'style' => 'success',
                        'message' => 'Serie created successfully'
                    ]);
                    // } else {
                    //     $this->reset();
                    //     $this->dispatchBrowserEvent('banner-message', [
                    //         'style' => 'danger',
                    //         'message' => 'Serie exists. Please try again'
                    //     ]);
                    // }
                    // } else {
                    //     $this->dispatchBrowserEvent('banner-message', [
                    //         'style' => 'danger',
                    //         'message' => 'Serie ID is not found. Please try again'
                    //     ]);
                    // }
                }
            }
        } else {
            $this->dispatchBrowserEvent('banner-message', [
                'style' => 'danger',
                'message' => 'Api not exists. Please try again'
            ]);
        }
    }

    public function  showEditModal($id)
    {
        $this->serieId = $id;
        $this->loadSerie();
        $this->showSerieModal = true;
    }

    public function loadSerie()
    {
        $serie = Serie::findOrFail($this->serieId);
        $this->name = $serie->name;
        $this->created_year = $serie->created_year;
        $this->poster_path = $serie->poster_path;
    }
    public function updateSerie()
    {
        $this->validate();
        $serie = Serie::findOrFail($this->serieId);
        $serie->update([
            'name' => $this->name,
            'slug'    => Str::slug($this->name),
            'created_year' => $this->created_year,
            'poster_path' => $this->poster_path
        ]);
        $this->reset();

        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Serie updated successfully'
        ]);
    }
    public function deleteSerie($id)
    {
        $serie = Serie::findOrFail($id);
        $serie->delete();
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Serie deleted successfully'
        ]);
    }
    public function resetFilters()
    {
        $this->reset();
    }
    public function closeSerieModal()
    {
        $this->showSerieModal = false;
    }

    public function render()
    {
        return view('livewire.serie-index', [
            'series' => Serie::when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%');
            })->orderBy('name', $this->sort)->paginate($this->perPage)
        ]);
    }
}
