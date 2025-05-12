<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Rooms extends Component
{
    public function render()
    {
        return view('livewire.pages.rooms')
            ->layout('layouts.app-sidebar', ['title' => 'Rooms']);
    }
}
