<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
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
        return view('livewire.search', [
            'results' => Post::where('barta', 'LIKE', '%'. $this->search .'%')->latest()->get()
        ]);
    }
}
