<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public ?Post $post;

    #[Validate('required')]
    public string $barta = '';

    #[Validate('nullable|image|max:1024', as: 'photo')]
    public $tempPhoto;

    public string $photo = '';


    public function mount()
    {

    }

    public function create()
    {
        $this->validate();

        if ($this->tempPhoto) {
            $this->photo = $this->tempPhoto->storePublicly('posts', 'public');
        }

        auth()->user()->posts()->create($this->all());
    }
}
