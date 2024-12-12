<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostInfo extends Component
{
    public array $ids;

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
    }

    public function toggleLike(Post $post)
    {
        $post->toggleLike(auth()->user());
    }

    public function render()
    {
        return view('livewire.post-info', [
            'posts' => Post::with('author')->whereIn('id', $this->ids)->withCount('comments')->latest()->get(),
        ]);
    }
}
