<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentIndex extends Component
{
    public ?int $post_id;

    public int $page = 0;

    public array $chunks;

    public function mount()
    {
        $this->chunks = Comment::where('post_id', $this->post_id)->with('author')->latest()->pluck('id')->chunk(10)->toArray();
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
        return view('livewire.comment-index');
    }
}
