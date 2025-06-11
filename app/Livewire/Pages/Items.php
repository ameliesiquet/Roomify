<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Items extends Component
{
    private function getItemMessages($user): array
    {
        $messages = [];

        if (!$user) {
            return $messages;
        }

        $messages[] = [
            'icon' => '💬',
            'message' => "You haven’t saved any items yet...🪑\nStart exploring and save items you love. \n\nThey’ll show up here. 💫",
            'linkText' => 'start now',
            'linkHref' => route('shopping'),
            'time' => now()->format('H:i'),
        ];
        return $messages;
    }

    public function render()
    {
        $user = Auth::user();
        return view('livewire.pages.items', [
            'itemMessages' => $this->getItemMessages($user),
        ])->layout('layouts.app-sidebar', [
            'title' => 'Your Items',
        ]);
    }
}
