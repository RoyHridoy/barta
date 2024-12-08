<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateCommentForm;
use App\Livewire\Forms\EditCommentForm;
use App\Models\Comment;
use Livewire\Component;

class CommentItem extends Component
{
    public Comment $comment;

    public CreateCommentForm $createReplyForm;
    public EditCommentForm $commentEditForm;

    public bool $deleted = false;

    public function mount()
    {
        $this->commentEditForm->body = $this->comment->body;
    }

    public function edit()
    {
        $this->authorize('edit', $this->comment);
        $this->commentEditForm->validate();

        $this->comment->update($this->commentEditForm->only('body'));
        $this->dispatch('edited');
    }

    public function reply()
    {
        $this->authorize('reply', $this->comment);
        $this->createReplyForm->validate();

        $comment = $this->comment->children()->make($this->createReplyForm->only('body'));
        $comment->author()->associate(auth()->user());
        $comment->save();

        $this->dispatch('replied');
        $this->createReplyForm->reset();
    }

    public function delete()
    {
        $this->authorize('delete', $this->comment);
        $this->comment->delete();
        $this->deleted = true;
    }

    public function render()
    {
        return view('livewire.comment-item');
    }
}
