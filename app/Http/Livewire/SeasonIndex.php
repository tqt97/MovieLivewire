<?php

namespace App\Http\Livewire;

use App\Models\Season;
use App\Models\Serie;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class SeasonIndex extends Component
{
    use WithPagination;

    public Serie $serie;
    public $name, $season_number, $slug, $poster_path, $season_id, $tmdb_id;
    public $showSeasonModal = false;

    protected $key = 'f7c944d484153416dadeaf04b9065872';

    public $search = '';
    public $sortColumn = 'name';
    public $sort = 'asc';
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $rules = [
        'name' => 'required',
        'poster_path' => 'required',
        'season_number' => 'required'
    ];
    public function generateSeason()
    {
        // $season = Season::Where('season_number', $this->season_number)->exists();
        // if($season){
        //     $this->dispatchBrowserEvent('banner-message', [
        //         'style' => 'danger',
        //         'message' => 'Season already exists'
        //     ]);
        //     return;
        // }
        $newSeason = Http::get('https://api.themoviedb.org/3/tv/' . $this->serie->tmdb_id . '/season/' . $this->season_number . '?api_key=' . $this->key . '&language=en-US');
        // dd($newSeason);
        if ($newSeason->ok()) {
            if (!$this->season_number) {
                $this->dispatchBrowserEvent('banner-message', [
                    'style' => 'danger',
                    'message' => 'Season ID is empty. Please enter a valid Season ID.'
                ]);
            } else {
                if (!is_numeric($this->season_number)) {
                    $this->dispatchBrowserEvent('banner-message', [
                        'style' => 'danger',
                        'message' => 'Season ID is a number. Please try again'
                    ]);
                } else {
                    // if (count($newSeason) != 3) {
                    $season = Season::where('tmdb_id', $newSeason['id'])->exists();
                    if (!$season) {
                        Season::create([
                            'serie_id' => $this->serie->id,
                            'tmdb_id' => $newSeason['id'],
                            'name'    => $newSeason['name'],
                            'slug'    => Str::slug($newSeason['name']),
                            'season_number' => $newSeason['season_number'],
                            'poster_path' => $newSeason['poster_path'] ? $newSeason['poster_path'] : $this->serie->poster_path
                        ]);
                        $this->reset('season_number');
                        $this->dispatchBrowserEvent('banner-message', [
                            'style' => 'success',
                            'message' => 'Season created successfully'
                        ]);
                    } else {
                        $this->reset(['season_number']);

                        $this->dispatchBrowserEvent('banner-message', [
                            'style' => 'danger',
                            'message' => 'Season exists. Please try again'
                        ]);
                    }
                    // } else {
                    //     $this->reset(['season_number']);

                    //     $this->dispatchBrowserEvent('banner-message', [
                    //         'style' => 'danger',
                    //         'message' => 'Season ID is not found. Please try again'
                    //     ]);
                    // }
                }
            }
        } else {
            $this->reset(['season_number']);

            $this->dispatchBrowserEvent('banner-message', [
                'style' => 'danger',
                'message' => 'Api not exists. Please try again'
            ]);
        }
    }
    public function  showEditModal($id)
    {
        $this->season_id = $id;
        $this->loadSeason();
        $this->showSeasonModal = true;
    }

    public function loadSeason()
    {
        $season = Season::findOrFail($this->season_id);
        $this->name = $season->name;
        $this->season_number = $season->season_number;
        $this->poster_path = $season->poster_path;
    }
    public function updateSeason()
    {
        $this->validate();
        $season = Season::findOrFail($this->season_id);
        $season->update([
            'name' => $this->name,
            'slug'    => Str::slug($this->name),
            'season_number' => $this->season_number,
            'poster_path' => $this->poster_path
        ]);
        $this->reset(['season_number', 'name', 'poster_path', 'season_id', 'showSeasonModal']);
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Season updated successfully'
        ]);
    }
    public function deleteSeason($id)
    {
        $season = Season::findOrFail($id);
        $name = $season->name;
        $season->delete();
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => $name . ' deleted successfully'
        ]);
    }
    public function resetFilters()
    {
        $this->reset();
        $this->reset('season_number');
    }
    public function closeSeasonModal()
    {
        $this->showSeasonModal = false;
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
    public function render()
    {
        return view('livewire.season-index', [
            'seasons' => Season::when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
}
