<?php

namespace App\Livewire;

use Livewire\Component;

class TiptapEditor extends Component
{
    public $content;

    public function render()
    {
        return view('livewire.tiptap-editor');
    }
}
