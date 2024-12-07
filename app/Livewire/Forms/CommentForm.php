<?php

namespace App\Livewire\Forms;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CommentForm extends Form
{
    public ?Post $post;

    public ?Comment $comment;

    #[Validate('required|string')]
    public string $body = '';

    #[Validate('required|int|exists:posts,id')]
    public ?int $post_id;

    public function save()
    {
        auth()->user()->comments()->create($this->validate());
        $this->reset('body');
    }

    public function update() {}

    public function setComment(Post $post, ?Comment $comment = null)
    {
        $this->post = $post;
        $this->post_id = $post->id;
        if ($comment) {
            $this->comment = $comment;
        }
    }
}
