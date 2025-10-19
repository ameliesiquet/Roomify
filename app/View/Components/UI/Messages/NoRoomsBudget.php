<?php

namespace App\View\Components\UI\Messages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NoRoomsBudget extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.u-i.messages.no-rooms-budget');
    }
}
