<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SearchResult extends Component
{
    #[Reactive]
    public $show;

    #[Reactive()]
    public ?Collection $results;

    public function render()
    {
        return view('livewire.search-result');
    }
}
