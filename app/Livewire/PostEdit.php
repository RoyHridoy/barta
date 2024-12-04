<?php

namespace App\Livewire;

use App\Livewire\Forms\PostForm;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class PostEdit extends Component
{
    use WithFileUploads;
    public PostForm $form;

    public function mount(Post $post)
    {
        $this->form->setForm($post);
    }

    public function update()
    {
        $this->form->update();

        session()->flash('status', 'Barta successfully updated.');
    }

    public function render()
    {
        return view('livewire.post-edit');
    }
}
