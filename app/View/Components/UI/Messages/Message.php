<?php

namespace App\View\Components\UI\Messages;

use Illuminate\View\Component;

class Message extends Component
{
    public string $message;
    public ?string $linkText;
    public ?string $linkHref;
    public ?string $time;

    public function __construct(
        string $message = '',
        ?string $linkText = null,
        ?string $linkHref = null,
        ?string $time = null
    ) {
        $this->message = $message;
        $this->linkText = $linkText;
        $this->linkHref = $linkHref;
        $this->time = $time;
    }

    public function render()
    {
        return view('components.ui.messages.message');
    }
}
