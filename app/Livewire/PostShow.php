<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PostShow extends Component
{
    public ?Post $post;

    public function mount(Post $post)
    {
        $this->post = $post->load('comments.author')->loadCount('comments');
    }

    public function render()
    {
        return view('livewire.post-show');
    }
}
