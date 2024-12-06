<?php

namespace App\Livewire;

use App\Livewire\Forms\PostForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostCreate extends Component
{
    use WithFileUploads;
    public PostForm $form;

    public function save()
    {
        $this->form->create();

        $this->redirectRoute('home', navigate: true);
    }

    public function render()
    {
        return view('livewire.post-create');
    }
}
