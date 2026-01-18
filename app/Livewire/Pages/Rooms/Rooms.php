<?php

namespace App\Livewire\Pages\Rooms;

use App\Models\Item;
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

    public $editingBudget = false;
    public $editingBudgetValue = null;

    public function mount()
    {
        $this->loadRooms();
    }

    public function loadRooms()
    {
        $user = Auth::user();
        $this->rooms = $user->rooms()->with('items')->get();
        $this->messages = $this->getMessages();
    }

    public function openAddRoomModal()
    {
        $this->showAddRoomModal = true;
        $this->todo_list = [[
            'text' => '',
            'completed' => false,
        ]];
    }

    public function closeAddRoomModal()
    {
        $this->showAddRoomModal = false;
        $this->reset(['name', 'budget', 'colors', 'todo_list']);
    }

    public function openRoomDetailsModal($roomId)
    {
        $this->selectedRoomForDetails = $this->rooms->find($roomId);
        $this->editingBudget = false;
        $this->showRoomDetailsModal = true;
    }

    public function closeRoomDetailsModal()
    {
        $this->showRoomDetailsModal = false;
        $this->selectedRoomForDetails = null;
        $this->editingBudget = false;
    }

    public function openBudgetEditModal()
    {
        $this->editingBudget = true;
        $this->editingBudgetValue = $this->selectedRoomForDetails->budget;
    }

    public function cancelBudgetEdit()
    {
        $this->editingBudget = false;
        $this->editingBudgetValue = null;
    }

    public function saveBudgetEdit()
    {
        $this->validate([
            'editingBudgetValue' => 'required|numeric|min:0',
        ]);

        $this->selectedRoomForDetails->budget = $this->editingBudgetValue;
        $this->selectedRoomForDetails->save();

        $this->editingBudget = false;
        $this->editingBudgetValue = null;

        $this->loadRooms();
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'budget' => 'nullable|numeric|min:0',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Please enter a room name.',
            'name.max' => 'The room name may not be greater than 255 characters.',
            'budget.numeric' => 'Budget must be a number.',
            'budget.min' => 'Budget must be at least 0.',
        ];
    }

    public function createRoom()
    {
        $this->validate();
        $user = Auth::user();

        Room::create([
            'user_id' => $user->id,
            'name' => $this->name,
            'budget' => $this->budget ?: 0,
            'spent' => 0,
            'colors' => $this->colors,
            'todo_list' => $this->todo_list,
        ]);

        session()->flash('message', 'Raum "' . $this->name . '" wurde erfolgreich erstellt!');

        $this->closeAddRoomModal();
        $this->loadRooms();
    }

    public function addColor()
    {
        $this->colors[] = '#d6d3c9';
    }

    public function removeColor($index)
    {
        unset($this->colors[$index]);
        $this->colors = array_values($this->colors);
    }

    public function addTodo()
    {
        $this->todo_list[] = [
            'text' => '',
            'completed' => false,
        ];
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
            ->filter(fn($r) => $r->is_example !== true)
            ->count();

        if ($realRoomsCount === 0) {
            $messages[] = [
                'component' => 'ui.messages.no-rooms-message',
                'props' => [],
            ];
        }

        return $messages;
    }

    public function deleteRoom()
    {
        if (!$this->selectedRoomForDetails) return;

        Room::find($this->selectedRoomForDetails->id)?->delete();

        session()->flash('message', 'Room deleted successfully.');

        $this->closeRoomDetailsModal();
        $this->loadRooms();
    }

    public function addItemToRoom($itemId, $roomId)
    {
        $room = Room::find($roomId);
        $item = Item::find($itemId);

        if (!$room || !$item) return;

        $existing = $room->items()->where('item_id', $itemId)->first();

        if ($existing) {
            $room->items()->updateExistingPivot($itemId, [
                'quantity' => $existing->pivot->quantity + 1
            ]);
        } else {
            $room->items()->attach($itemId, ['quantity' => 1]);
        }

        if ($item->price) {
            $room->increment('spent', $item->price);
        }

        $room->load('items');
        $this->loadRooms();
    }

    public function removeItemFromRoom($itemId, $roomId)
    {
        $room = Room::find($roomId);
        $item = Item::find($itemId);

        if (!$room || !$item) return;

        $room->items()->detach($itemId);

        if ($item->price) {
            $room->decrement('spent', $item->price);
        }

        $room->load('items');
        $this->loadRooms();
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
