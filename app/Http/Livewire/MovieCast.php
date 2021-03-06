<?php

namespace App\Http\Livewire;

use App\Models\Cast;
use Livewire\Component;

class MovieCast extends Component
{
    public $queryCast = '';
    public $movie;
    public $casts = [];
    public $selectCast = [];

    public function mount($movie)
    {
        $this->movie = $movie;
    }
    public function asyncCasts()
    {
        if (count($this->selectCast)) {
            $this->movie->casts()->syncWithoutDetaching($this->selectCast);
            $this->reset('queryCast');
            $this->emit('castAdded');
        }else{
            $this->emit('noCastSelected');
        }
    }
    public function updatedQueryCast()
    {
        $this->casts = Cast::search('name', $this->queryCast)->get();
    }
    public function addCast($id)
    {
        $cast = Cast::findOrFail($id);
        $this->movie->casts()->attach($cast);
        $this->reset('queryCast');
        $this->emit('castAdded');
    }
    public function detachCast($id)
    {
        $this->movie->casts()->detach($id);
        $this->reset('queryCast');
        $this->emit('castDetached');
    }
    public function render()
    {
        return view('livewire.movie-cast');
    }
}
