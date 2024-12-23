<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateCommentForm;
use App\Models\Post;
use App\Notifications\CommentCreated;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Comments extends Component
{
    public Post $post;

    public int $page = 1;

    public array $chunks = [];

    public CreateCommentForm $createCommentForm;

    public function mount()
    {
        $this->chunks = $this->post->comments()->pluck('id')->chunk(10)->toArray();
    }

    public function createComment()
    {
        $this->createCommentForm->validate();
        $comment = $this->post->comments()->make($this->createCommentForm->only('body'));
        $comment->author()->associate(auth()->user());
        $comment->save();

        if (count($this->chunks) === 0) {
            $this->chunks[] = [];
        }

        array_unshift($this->chunks[0], $comment->id);
        $this->createCommentForm->reset();

        if ($this->post->author->id !== $comment->author->id) {
            $this->post->author->notify(new CommentCreated($comment, $this->post->author->fullName));
        }
    }

    public function loadMore()
    {
        if (! $this->hasMorePages()) {
            return;
        }
        $this->page++;
    }

    public function hasMorePages(): bool
    {
        return $this->page < count($this->chunks);
    }

    #[Computed()]
    public function totalComments()
    {
        return array_sum(array_map('count', $this->chunks));
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
