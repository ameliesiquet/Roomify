<?php

namespace App\Livewire\Pages;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class Dashboard extends Component
{
    public $message = [];
    private function getDashboardMessages($user): array
    {
        $messages = [];

        if (!$user) {
            return $messages;
        }

        if ($user) {
            $messages[] = [
                'icon' => '💬',
                'message' => "Welcome to Roomify! 🏡✨\nLet’s get started — create your first room or browse for inspiration.\n\n➡️ Tip: Start with the room you use the most — maybe your bedroom?",

                'linkText' => 'Add your first room',
                'linkHref' => route('rooms'),
                'time' => now()->format('H:i'),
            ];
        }
        return $messages;
    }
    public function render()
    {

        $user = auth()->user();

        if ($user instanceof \App\Models\User) {
            $dashboardMessages = $this->getDashboardMessages($user);
        } else {
            $dashboardMessages = [];
        }


        return view('livewire.pages.dashboard', [
            'dashboardMessages' => $dashboardMessages,
        ])->layout('layouts.app-sidebar', [
            'title' => $user ? "Welcome, {$user->firstname}!" : 'Dashboard',
        ]);
    }

}
