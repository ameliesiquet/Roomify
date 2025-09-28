<?php

namespace App\View\Components\UI\Messages;

use Illuminate\View\Component;

class WelcomeMessage extends Component
{
    public string $username;

    public function __construct(string $username = '')
    {
        $this->username = $username;
    }


    public function render()
    {
        return view('components.ui.messages.welcome-message');
    }
}
