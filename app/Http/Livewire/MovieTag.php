<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;

class MovieTag extends Component
{

    public $queryTag = '';
    public $movie;
    public $tags = [];

    public function mount($movie)
    {
        $this->movie = $movie;
    }
    public function updatedQueryTag()
    {
        $this->tags = Tag::search('tag_name', $this->queryTag)->get();
    }
    public function addTag($id)
    {
        $tag = Tag::findOrFail($id);
        $this->movie->tags()->attach($tag);
        $this->reset('queryTag');
        $this->emit('tagAdded');
    }
    public function detachTag($id)
    {
        $this->movie->tags()->detach($id);
        $this->reset('queryTag');
        $this->emit('tagDetached');
    }
    public function render()
    {
        return view('livewire.movie-tag');
    }
}
