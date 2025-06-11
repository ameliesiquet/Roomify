<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Rooms extends Component
{
    private function getRoomMessages($user): array
    {
        $messages = [];

        if (!$user) {
            return $messages;
        }

        $messages[] = [
            'icon' => '💬',
            'message' => "No custom rooms created yet 🛋️\nLet’s bring your space to life!\n Start by adding your first room — bedroom, kitchen, or anything you like. ✨   \n\nHere you can see an example ⬇️",
            'linkText' => 'start now',
            'linkHref' => route('shopping'),
            'time' => now()->format('H:i'),
        ];
        return $messages;
    }
    public function render()
    {
        $user = Auth::user();
        return view('livewire.pages.rooms', [
            'roomMessages' => $this->getRoomMessages($user),
        ])->layout('layouts.app-sidebar', [
            'title' => 'Your Rooms',
        ]);
    }
}
