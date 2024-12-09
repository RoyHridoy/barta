<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ProfileStats extends Component
{
    public User $user;

    public function mount()
    {
        $this->user->loadCount('posts', 'comments');
    }

    public function render()
    {
        return view('livewire.profile-stats');
    }
}
