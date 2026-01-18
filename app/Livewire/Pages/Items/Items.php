<?php

namespace App\Livewire\Pages\Items;

use App\Models\Item;
use App\Models\Room;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Items extends Component
{
    public $items = [];
    public $rooms = [];
    public $categories = [];

    public function mount()
    {
        $user = Auth::user();


        $this->rooms = $user->rooms()->get();


        $this->items = $this->rooms
            ->pluck('items')
            ->flatten();


        $this->categories = $this->items
            ->pluck('category')
            ->filter()
            ->unique()
            ->values();
    }

    protected function getMessages(): array
    {
        if ($this->items->isEmpty()) {
            return [
                [
                    'component' => 'ui.messages.no-items-message',
                    'props' => [],
                ]
            ];
        }

        return [];
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
    }
    public function render()
    {
        return view('livewire.pages.items.items', [
            'items' => $this->items,
            'rooms' => $this->rooms,
            'categories' => $this->categories,
            'messages' => $this->getMessages(),
        ])->layout('layouts.app-sidebar', [
            'title' => 'Your Items',
        ]);
    }
}
