<?php

namespace App\Livewire\Pages\Profile;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.pages.profile.profile')
            ->layout('layouts.app-sidebar', [
                'title' =>  'Your Profile',
            ]);
    }
}
