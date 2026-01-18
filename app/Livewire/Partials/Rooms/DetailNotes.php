<?php

namespace App\Livewire\Partials\Rooms;

use Livewire\Component;
use App\Models\Room;

class DetailNotes extends Component
{
    public Room $room;
    public bool $editingNotes = false;
    public string $notesDraft = '';

    public function edit()
    {
        $this->notesDraft = $this->room->notes ?? '';
        $this->editingNotes = true;
    }

    public function save()
    {
        $this->room->update([
            'notes' => trim($this->notesDraft),
        ]);

        $this->editingNotes = false;
    }

    public function cancel()
    {
        $this->editingNotes = false;
    }

    public function render()
    {
        return view('livewire.partials.rooms.detail-notes');
    }
}
