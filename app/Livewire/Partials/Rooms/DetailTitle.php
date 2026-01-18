<?php

namespace App\Livewire\Partials\Rooms;

use Livewire\Component;
use App\Models\Room;

class DetailTitle extends Component
{
    public Room $room;
    public bool $editing = false;
    public string $titleDraft = '';

    public function edit()
    {
        $this->titleDraft = $this->room->name;
        $this->editing = true;
    }

    public function save()
    {
        $this->validate([
            'titleDraft' => 'required|string|max:255',
        ]);

        $this->room->update([
            'name' => trim($this->titleDraft),
        ]);

        $this->editing = false;
    }

    public function cancel()
    {
        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.partials.rooms.detail-title');
    }
}
