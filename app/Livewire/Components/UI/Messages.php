<?php

namespace App\Livewire\Components\UI;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Livewire\Attributes\On;

class Messages extends Component
{
    public array $messages = [];

    public function mount(array $messages = []): void
    {
        $this->messages = $messages;
    }

    public function render()
    {
        return view('livewire.components.ui.messages');
    }
}

