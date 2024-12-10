<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateCommentForm;
use App\Livewire\Forms\EditCommentForm;
use App\Models\Comment;
use App\Notifications\ReplyCreated;
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

        if ($comment->user_id !== $this->comment->user_id) {
            $postId = Comment::where('id', $comment->parent_id)->first()->post_id;
            $this->comment->author->notify(new ReplyCreated(
                $comment,
                $postId,
                $this->comment->author->fullName
            ));
        }
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
