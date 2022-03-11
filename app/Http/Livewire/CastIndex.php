<?php

namespace App\Http\Livewire;

use App\Models\Cast;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class CastIndex extends Component
{
    use WithPagination;

    protected $key = 'f7c944d484153416dadeaf04b9065872';

    public $castTMDBId;
    public $name, $poster_path;

    public $search = '';
    public $sort = 'asc';
    public $perPage = 10;

    public $castId;
    public $showCastModal = false;

    protected $rules = [
        'name' => 'required',
        'poster_path' => 'required',
    ];

    public function generateCast()
    {
        $cast = Cast::where('tmdb_id', $this->castTMDBId)->exists();
        if ($cast) {
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Cast already exists']);
            return;
        }
        $url = 'https://api.themoviedb.org/3/person/' . $this->castTMDBId . '?api_key=' . $this->key . '&language=en-US';
        $apiCast = Http::get($url);
        if ($apiCast->successful()) {
            if (!$this->castTMDBId) {
                $this->dispatchBrowserEvent('banner-message', [
                    'style' => 'danger',
                    'message' => 'Cast ID is empty. Please enter a valid Cast ID.'
                ]);
            } else {
                if (!is_numeric($this->castTMDBId)) {
                    $this->dispatchBrowserEvent('banner-message', [
                        'style' => 'danger',
                        'message' => 'Cast ID is a number. Please try again'
                    ]);
                } else {
                    $newCast = $apiCast->json();
                    Cast::create([
                        'tmdb_id' => $newCast['id'],
                        'name'    => $newCast['name'],
                        'slug'    => Str::slug($newCast['name']),
                        'poster_path' => $newCast['profile_path']
                    ]);
                    $this->reset();
                    $this->dispatchBrowserEvent('banner-message', [
                        'style' => 'success',
                        'message' => 'Cast created successfully'
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
        $this->castId = $id;
        $this->loadCast();
        $this->showCastModal = true;
    }

    public function loadCast()
    {
        $cast = Cast::findOrFail($this->castId);
        $this->name = $cast->name;
        $this->poster_path = $cast->poster_path;
    }

    public function updateCast()
    {
        $this->validate();
        $cast = Cast::findOrFail($this->castId);
        $cast->update([
            'name' => $this->name,
            'slug'    => Str::slug($this->name),
            'poster_path' => $this->poster_path
        ]);
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Cast updated'
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
        Cast::findOrFail($id)->delete();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Cast deleted']);
        $this->reset();
    }

    public function resetFilters()
    {
        $this->reset();
    }

    public function render()
    {
        // return view('livewire.cast-index', [
        //     'casts' => Cast::search('name', $this->search)->orderBy('name', $this->sort)->paginate($this->perPage),
        // ]);
        return view('livewire.cast-index', [
            'casts' => Cast::when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%');
            })->orderBy('name', $this->sort)->paginate($this->perPage)
        ]);
    }
}
