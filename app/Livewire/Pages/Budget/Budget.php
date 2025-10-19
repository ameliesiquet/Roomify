<?php

namespace App\Livewire\Pages\Budget;

use Livewire\Component;

class Budget extends Component
{
    protected function getMessages(): array
    {
        $messages = [];

        $messages[] = [
            'component' => 'ui.messages.no-budget-message',
            'props' => [],
        ];

        return $messages;
    }

    public function render()
    {
        return view('livewire.pages.budget.budget', [
            'messages' => $messages = $this->getMessages(),
        ])->layout('layouts.app-sidebar', [
            'title' => 'Your Budget',
        ]);
    }
}
