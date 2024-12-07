<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public ?Post $post;

    #[Validate('required')]
    public string $barta = '';

    #[Validate('nullable|image|max:1024', as: 'photo')]
    public $tempPhoto;

    public ?string $photo = '';

    public function setForm(Post $post)
    {
        $this->post = $post;
        $this->barta = $post->barta;
        $this->photo = $post->photo;
    }

    public function create()
    {
        $this->validate();

        if ($this->tempPhoto) {
            $this->photo = $this->tempPhoto->storePublicly('posts', 'public');
        }

        auth()->user()->posts()->create($this->all());
    }

    public function update()
    {
        $this->validate();

        if ($this->tempPhoto) {
            if ($this->photo) {
                Storage::disk('public')->delete($this->photo);
            }
            $this->photo = $this->tempPhoto->storePublicly('posts', 'public');
        }

        $this->post->update($this->only('barta', 'photo'));
    }
}
