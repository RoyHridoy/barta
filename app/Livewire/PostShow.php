<?php

namespace App\Livewire;

use App\Livewire\Forms\CommentCreateForm;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class PostShow extends Component
{
    public ?Post $post;

    public function render()
    {
        return view('livewire.post-show');
    }
}
