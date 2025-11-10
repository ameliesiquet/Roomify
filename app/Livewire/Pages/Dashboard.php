<?php

namespace App\Livewire\Pages;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $messages = [];
    public $inspirations = [];

    public function mount()
    {
        $this->inspirations = Item::where('is_public', true)->inRandomOrder()->take(5)->get();
        $this->messages = $this->getMessages();
    }

    protected function getMessages(): array
    {
        $user = Auth::user();

        return [
            [
                'component' => 'ui.messages.welcome-message',
                'props' => [
                    'username' => $user->firstname,
                ],
            ]
        ];
    }

    public function render()
    {
        $user = auth()->user();

        return view('livewire.pages.dashboard', [
            'messages' => $this->messages,
            'inspirations' => $this->inspirations,
        ])->layout('layouts.app-sidebar', [
            'title' => $user ? "Welcome, {$user->firstname}!" : 'Dashboard',
        ]);
    }
}
