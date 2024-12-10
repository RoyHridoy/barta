<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class SearchResult extends Component
{
    #[Reactive]
    public $show;

    #[Reactive()]
    public $posts;

    public function render()
    {
        return view('livewire.search-result');
    }
}
