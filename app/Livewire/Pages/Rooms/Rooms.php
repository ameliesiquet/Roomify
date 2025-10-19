<?php

namespace App\Livewire\Pages\Rooms;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Rooms extends Component
{
    protected function getMessages(): array
    {
        $messages = [];

        $messages[] = [
            'component' => 'ui.messages.no-rooms-message',
            'props' => [],
        ];
        // wenn räume und so kommen anpassen mit mereren optionen

        return $messages;
    }
    public function render()
    {
        $user = Auth::user();
        return view('livewire.pages.rooms.rooms', [
            'messages' => $messages = $this->getMessages(),
        ])->layout('layouts.app-sidebar', [
            'title' => 'Your Rooms',
        ]);
    }
}
