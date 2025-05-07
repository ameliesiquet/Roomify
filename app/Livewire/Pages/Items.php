<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Items extends Component
{
    public function render()
    {
        return view('livewire.pages.items')
            ->layout('layouts.app-sidebar', ['title' => 'Items']);
    }
}
