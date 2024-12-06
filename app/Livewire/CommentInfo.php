<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentInfo extends Component
{
    public array $ids;

    public function delete(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        $this->dispatch('commentDeleted');
    }

    public function save()
    {
        auth()->user()->comments()->create($this->validate());
    }

    public function render()
    {
        return view('livewire.comment-info', [
            'comments' => Comment::whereIn('id', $this->ids)->with('author')->latest()->get()
        ]);
    }
}
