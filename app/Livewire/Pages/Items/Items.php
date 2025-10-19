<?php

namespace App\Livewire\Pages\Items;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Items extends Component
{
    protected function getMessages(): array
    {
        $messages = [];

        $messages[] = [
            'component' => 'ui.messages.no-items-message',
            'props' => [],
        ];
        // wenn räume und so kommen anpassen mit mereren optionen

        return $messages;
    }
    public function render()
    {
        return view('livewire.pages.items.items', [
            'messages' => $messages = $this->getMessages(),
        ])->layout('layouts.app-sidebar', [
            'title' => 'Your Items',
        ]);
    }
}

