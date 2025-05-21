<?php

namespace App\Livewire\Pages;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class Dashboard extends Component
{
    public function mount()
    {
        logger()->info('DASHBOARD User:', ['user' => Auth::user()]);
    }


    public function render()
    {
        return view('livewire.pages.dashboard')
            ->layout('layouts.app-sidebar');
    }
}
