<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Search extends Component
{
    #[Validate('required|string')]
    #[Url(as: 'q', except: '', history: true)]
    public string $search = '';

    public function render()
    {
        $posts = [];
        if ($this->search) {
            $posts = Post::query()
                ->with('author')
                ->where('barta', 'LIKE', "%{$this->search}%")
                ->orWhereRelation('author', 'username', 'LIKE', "%{$this->search}%")
                ->orWhereRelation('author', function ($query) {
                    $query->whereRaw("firstName || ' ' || lastName LIKE '%{$this->search}%'");
                })
                ->latest()->get();
        }

        return view('livewire.search', compact('posts'));
    }
}
