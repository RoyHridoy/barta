<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateCommentForm extends Form
{
    #[Validate('required|string')]
    public string $body = '';
}
