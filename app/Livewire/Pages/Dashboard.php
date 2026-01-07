<?php

namespace App\Livewire\Pages;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class Dashboard extends Component
{
    public array $messages = [];
    private function getDashboardMessages($user): array
    {
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        $messages = [];
=======
=======
>>>>>>> Stashed changes
        $this->inspirations = Item::where('is_public', true)->inRandomOrder()->take(20)->get();
        $this->messages = $this->getMessages();
    }
>>>>>>> Stashed changes

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
        $user = Auth::user();

        return view('livewire.pages.dashboard', [
            'dashboardMessages' => $this->getDashboardMessages($user),
        ])->layout('layouts.app-sidebar', [
            'title' => $user ? "Welcome, {$user->firstname}!" : 'Dashboard',
        ]);
    }

}
