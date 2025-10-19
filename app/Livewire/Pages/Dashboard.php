<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $message = [];

    protected function getMessages(): array
    {
        $messages = [];
        $user = Auth::user();

        $messages[] = [
            'component' => 'ui.messages.welcome-message',
            'props' => [
                'username' => $user->firstname,
            ],
        ];

        return $messages;
    }


    public function render()
    {

        $user = auth()->user();

        return view('livewire.pages.dashboard', [
            'messages' => $messages = $this->getMessages(),
        ])->layout('layouts.app-sidebar', [
            'title' => $user ? "Welcome, {$user->firstname}!" : 'Dashboard',
        ]);
    }

}
