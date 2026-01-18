<?php

namespace App\Livewire\Pages;

use AllowDynamicProperties;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

#[AllowDynamicProperties]
class Dashboard extends Component
{
    public $messages = [];
    public $inspirations = [];
    public $totalBudget = 0;
    public $totalSpent = 0;
    public $rooms = [];

    public function mount()
    {
        $this->inspirations = Item::where('is_public', true)->inRandomOrder()->take(10)->get();
        $this->loadUserData();
        $this->messages = $this->getMessages();
    }

    protected function loadUserData()
    {
        $user = Auth::user();

        $this->rooms = $user->rooms()->with('items')->get();

        $this->totalBudget = $this->rooms->sum('budget');
        $this->totalSpent = $this->rooms->sum('spent');
    }

    protected function getMessages()
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
            'totalBudget' => $this->totalBudget,
            'totalSpent' => $this->totalSpent,
            'rooms' => $this->rooms,
            'hasRooms' => $this->rooms->count() > 0,
            'hasBudget' => $this->totalBudget > 0,
        ])->layout('layouts.app-sidebar', [
            'title' => $user ? "Welcome, {$user->firstname}!" : 'Dashboard',
        ]);
    }
}
