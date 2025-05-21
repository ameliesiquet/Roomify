<?php

namespace App\Livewire\Pages;
use App\Models\User;
use Livewire\Component;
#[Middleware('auth')]
class Dashboard extends Component
{
    public User $user;
    public function mount()
    {
        $user = auth()->user();
        logger()->info('Dashboard-Komponente geladen', [
            'auth_check' => auth()->check(),
            'user' => auth()->user()?->username,
        ]);
    }

    public function render()
    {
        return view('livewire.pages.dashboard')
            ->layout('layouts.app-sidebar');
    }
}
