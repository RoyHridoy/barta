<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostIndex extends Component
{
    public int $page = 0;

    public array $chunks;

    public function mount()
    {
        $this->chunks = Post::latest()->pluck('id')->chunk(15)->toArray();
        $this->loadMore();
    }

    public function loadMore()
    {
        $this->page++;
    }

    public function hasMorePages(): bool
    {
        return $this->page < count($this->chunks);
    }

    public function render()
    {
        return view('livewire.post-index');
    }
}
