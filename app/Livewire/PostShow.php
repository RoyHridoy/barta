<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PostShow extends Component
{
    public ?Post $post;

    public ?int $totalComments;

    public function mount(Post $post)
    {
        $this->post = $post->loadCount('comments');
        $this->totalComments = $this->post->comments_count;
    }

    // #[On('commentDeleted')]
    // public function commentDeleted()
    // {
    //     $this->totalComments -= 1;
    // }

    public function render()
    {
        return view('livewire.post-show');
    }
}
