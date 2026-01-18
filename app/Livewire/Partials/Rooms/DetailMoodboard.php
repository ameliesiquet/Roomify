<?php

namespace App\Livewire\Partials\Rooms;

use Livewire\Component;
use App\Models\Room;

class DetailMoodboard extends Component
{
    public Room $room;
    public bool $editing = false;
    public array $colorsDraft = [];

    public function edit()
    {
        $this->colorsDraft = $this->room->colors ?? [];
        $this->editing = true;
    }

    public function save()
    {
        $this->room->update([
            'colors' => $this->colorsDraft,
        ]);

        $this->editing = false;
    }

    public function addColor()
    {
        $this->colorsDraft[] = '#d6d3c9';
    }

    public function removeColor($index)
    {
        unset($this->colorsDraft[$index]);
        $this->colorsDraft = array_values($this->colorsDraft);
    }



    public function cancel()
    {
        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.partials.rooms.detail-moodboard');
    }
}
