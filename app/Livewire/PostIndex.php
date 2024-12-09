<?php

namespace App\Livewire;

use App\Livewire\Forms\PostForm;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostIndex extends Component
{
    use WithFileUploads;

    public ?User $user = null;

    public PostForm $form;

    public int $page = 0;

    public array $chunks;

    public function save()
    {
        $post = $this->form->create();

        if (count($this->chunks) == 0) {
            $this->chunks[] = [];
        }

        array_unshift($this->chunks[0], $post->id);

        $this->form->reset();
    }

    public function mount()
    {
        $this->chunks = Post::latest()
            ->when($this->user, function ($query) {
                $query->where('user_id', $this->user->id);
            })
            ->pluck('id')
            ->chunk(15)
            ->toArray();

        $this->loadMore();
    }

    public function loadMore()
    {
        $this->page++;
    }

    public function hasMorePages(): bool
    {
        return $this->page < count($this->chunks);
    }

    public function render()
    {
        return view('livewire.post-index');
    }
}
