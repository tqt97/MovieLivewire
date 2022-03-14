<?php

namespace App\Http\Livewire;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use App\Models\TrailerUrl;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class EpisodeIndex extends Component
{

    use WithPagination;

    public Season $season;
    public Serie $serie;

    public $name, $episode_number, $slug, $is_public, $season_id, $tmdb_id, $season_number, $episode_id, $overview;
    public $showEpisodeModal = false;
    public $showTrailer = false;
    public $episode;
    public $trailerName, $embedHtml;

    protected $key = 'f7c944d484153416dadeaf04b9065872';

    public $search = '';
    public $sort = 'asc';
    public $perPage = 10;
    public $sortColumn = 'name';
    public $sortDirection = 'asc';

    protected $rules = [
        'name' => 'required',
        'overview' => 'required',
        'episode_number' => 'required'
    ];
    public function generateEpisode()
    {
        $newEpisode =
            Http::get('https://api.themoviedb.org/3/tv/' . $this->serie->tmdb_id . '/season/' . $this->season->season_number . '/episode/' . $this->episode_number . '?api_key=' . $this->key . '&language=en-US');
        // dd($newEpisode);
        if ($newEpisode->ok()) {
            if (!$this->episode_number) {
                $this->dispatchBrowserEvent('banner-message', [
                    'style' => 'danger',
                    'message' => 'Episode ID is empty. Please enter a valid Season ID.'
                ]);
            } else {
                if (!is_numeric($this->episode_number)) {
                    $this->dispatchBrowserEvent('banner-message', [
                        'style' => 'danger',
                        'message' => 'Episode ID is a number. Please try again'
                    ]);
                } else {
                    $episode = Episode::where('tmdb_id', $newEpisode['id'])->first();
                    if (!$episode) {
                        Episode::create([
                            'season_id' => $this->season->id,
                            'tmdb_id' => $newEpisode['id'],
                            'name'    => $newEpisode['name'],
                            'slug'    => Str::slug($newEpisode['name']),
                            'episode_number' => $newEpisode['episode_number'],
                            'overview' => $newEpisode['overview'],
                            'is_public' => false,
                            'visits' => 1,
                        ]);
                        $this->reset('episode_number');
                        $this->dispatchBrowserEvent('banner-message', [
                            'style' => 'success',
                            'message' => 'Episode created successfully'
                        ]);
                    } else {
                        $this->reset(['episode_number']);

                        $this->dispatchBrowserEvent('banner-message', [
                            'style' => 'danger',
                            'message' => 'Episode exists. Please try again'
                        ]);
                    }
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
        $this->episode_id = $id;
        $this->loadEpisode();
        $this->showEpisodeModal = true;
    }

    public function loadEpisode()
    {
        $episode = Episode::findOrFail($this->episode_id);
        $this->name = $episode->name;
        $this->episode_number = $episode->episode_number;
        $this->is_public = $episode->is_public;
        $this->overview = $episode->overview;
    }
    public function updateEpisode()
    {
        $this->validate();
        $episode = Episode::findOrFail($this->episode_id);
        $episode->update([
            'name'    => $this->name,
            'slug'    => Str::slug($this->name),
            'episode_number' => $this->episode_number,
            'overview' => $this->overview,
            'is_public' => $this->is_public
        ]);
        $this->reset(['episode_number', 'name', 'overview', 'episode_id', 'showEpisodeModal', 'is_public']);
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Episode updated successfully'
        ]);
    }
    public function deleteEpisode($id)
    {
        $episode = Episode::findOrFail($id);
        $name = $episode->name;
        $episode->delete();
        $this->reset(['episode_number', 'name', 'overview', 'episode_id', 'showEpisodeModal', 'is_public']);
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => $name . ' deleted successfully'
        ]);
    }
    public function resetFilters()
    {
        $this->reset(['episode_number', 'episode_id', 'season_number', 'season_id']);
        $this->reset();
    }
    public function showTrailerModal($id)
    {
        $this->episode = Episode::findOrFail($id);
        $this->showTrailer = true;
    }
    public function closeTrailerModal()
    {
        $this->showTrailer = false;
    }

    public function addTrailer()
    {
        $this->episode->trailers()->create([
            'name' => $this->trailerName,
            'embed_html' => $this->embedHtml
        ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Trailer added']);
        $this->reset(['episode', 'showTrailer', 'trailerName', 'embedHtml']);
    }

    public function deleteTrailer($id)
    {
        $trailer = TrailerUrl::findOrFail($id);
        $trailer->delete();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Trailer deleted']);
        $this->reset(['episode', 'showTrailer', 'trailerName', 'embedHtml']);
    }
    public function closeEpisodeModal()
    {
        $this->showSeasonModal = false;
        $this->reset(['episode_number', 'name', 'overview', 'episode_id', 'showEpisodeModal', 'is_public']);
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
        return view('livewire.episode-index', [
            'episodes' => Episode::when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
}
