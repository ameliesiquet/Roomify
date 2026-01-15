<?php

namespace App\Livewire\Pages\Rooms;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class Rooms extends Component
{
    public $rooms;
    public $showAddRoomModal = false;
    public $showRoomDetailsModal = false;
    public $selectedRoomForDetails = null;


    public $name = '';
    public $budget = '';
    public $colors = [];
    public $todo_list = [];

    public function mount()
    {
        $this->loadRooms();
    }

    public function loadRooms()
    {
        $user = Auth::user();
        $this->rooms = $user->rooms()->with('items')->get();
    }

    public function openAddRoomModal()
    {
        $this->showAddRoomModal = true;
    }

    public function closeAddRoomModal()
    {
        $this->showAddRoomModal = false;
        $this->reset(['name', 'budget', 'colors', 'todo_list']);
    }

    public function openRoomDetailsModal($roomId)
    {
        logger('openRoomDetailsModal called with roomId: ' . $roomId);

        $this->selectedRoomForDetails = $this->rooms->find($roomId);

        logger('selectedRoomForDetails: ' . ($this->selectedRoomForDetails ? 'found' : 'null'));

        $this->showRoomDetailsModal = true;

        logger('showRoomDetailsModal set to: ' . $this->showRoomDetailsModal);
    }

    public function closeRoomDetailsModal()
    {
        $this->showRoomDetailsModal = false;
        $this->selectedRoomForDetails = null;
    }

    public function createRoom()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'budget' => 'nullable|numeric|min:0',
        ], [
            'name.required' => 'Bitte gib einen Raumnamen ein.',
            'name.max' => 'Der Raumname darf maximal 255 Zeichen lang sein.',
            'budget.numeric' => 'Das Budget muss eine Zahl sein.',
            'budget.min' => 'Das Budget muss mindestens 0 sein.',
        ]);

        $user = Auth::user();

        Room::create([
            'user_id' => $user->id,
            'name' => $this->name,
            'budget' => $this->budget ?: 0,
            'spent' => 0,
            'colors' => json_encode($this->colors),
            'todo_list' => json_encode($this->todo_list),
        ]);

        session()->flash('message', 'Raum "' . $this->name . '" wurde erfolgreich erstellt!');

        $this->closeAddRoomModal();
        $this->loadRooms();
    }

    public function addColor()
    {
        $this->colors[] = '#d6d3c9';
    }

    public function addTodo()
    {
        $this->todo_list[] = '';
    }

    public function removeTodo($index)
    {
        unset($this->todo_list[$index]);
        $this->todo_list = array_values($this->todo_list);
    }





    protected function getMessages(): array
    {
        $messages = [];
        $realRoomsCount = $this->rooms
            ->where('is_example', false)
            ->count();

        if ($realRoomsCount === 0) {
            $messages[] = [
                'component' => 'ui.messages.no-rooms-message',
                'props' => [],
            ];
        }

        return $messages;
    }

    public function render()
    {
        return view('livewire.pages.rooms.rooms', [
            'messages' => $this->getMessages(),
        ])->layout('layouts.app-sidebar', [
            'title' => 'Your Rooms',
        ]);
    }
}
