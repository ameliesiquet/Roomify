<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Shopping extends Component
{
    public function render()
    {
        return view('livewire.pages.shopping')
            ->layout('layouts.app-sidebar', [
                'title' =>  'Browse Items',
            ]);
    }
}
