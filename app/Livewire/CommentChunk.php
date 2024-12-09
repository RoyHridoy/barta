<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentChunk extends Component
{
    public array $ids;

    public function render()
    {
        return view('livewire.comment-chunk', [
            'comments' => Comment::whereIn('id', $this->ids)->with('author', 'children.author')->latest()->get(),
        ]);
    }
}
