<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Budget extends Component
{

    public function render()
    {
        return view('livewire.pages.budget')
            ->layout('layouts.app-sidebar', [
                'title' =>  'Your Budget',
            ]);
    }
}
