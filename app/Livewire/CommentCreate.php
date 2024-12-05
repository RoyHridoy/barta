<?php

namespace App\Livewire;

use App\Livewire\Forms\CommentForm;
use App\Models\Post;
use Livewire\Component;

class CommentCreate extends Component
{
    public CommentForm $form;

    public function mount(Post $post)
    {
        $this->form->setComment($post);
    }

    public function save()
    {
        $this->form->save();

        $this->dispatch('commentCreated');
    }

    public function render()
    {
        return view('livewire.comment-create');
    }
}
