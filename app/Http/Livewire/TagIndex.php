<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class TagIndex extends Component
{
    public $showTagModal = false;
    public $tag_name;
    public $Id;

    public $search = '';
    public $sort = 'asc';
    public $perPage = 10;
    public $sortColumn = 'tag_name';
    public $sortDirection = 'asc';


    public function showCreateModal()
    {
        $this->showTagModal = true;
    }

    public function create()
    {
        Tag::create([
            'tag_name' => $this->tag_name,
            'slug'     => Str::slug($this->tag_name)
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Tag created successfully'
        ]);
    }

    public function showEditModal($Id)
    {
        $this->reset(['tag_name']);
        $this->Id = $Id;
        $tag = Tag::find($Id);
        $this->tag_name = $tag->tag_name;
        $this->showTagModal = true;
    }

    public function update()
    {
        $tag = Tag::findOrFail($this->Id);
        $tag->update([
            'tag_name' => $this->tag_name,
            'slug'     => Str::slug($this->tag_name)
        ]);
        $this->reset();
        $this->showTagModal = false;
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => 'Tag updated successfully'
        ]);
    }

    public function delete($Id)
    {
        $tag = Tag::findOrFail($Id);
        $tag->delete();
        $this->reset();
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'danger',
            'message' => 'Tag deleted successfully'
        ]);
    }

    public function closeTagModal()
    {
        $this->showTagModal = false;
    }

    public function resetFilters()
    {
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
    public function render()
    {
        return view('livewire.tag-index', [
            'tags' => Tag::when($this->search, function ($query) {
                return $query->where('tag_name', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
}
