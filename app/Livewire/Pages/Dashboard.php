<?php

namespace App\Livewire\Pages;
use Livewire\Component;

class Dashboard extends Component
{


    public function mount()
    {
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
