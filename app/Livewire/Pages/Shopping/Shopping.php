<?php

namespace App\Livewire\Pages\Shopping;

use App\Models\Item;
use App\Models\Room;
use Livewire\Component;

class Shopping extends Component
{
    public $items;
    public $categories;
    public $rooms;

    public function mount()
    {

        $user = auth()->user();
        $this->items = Item::where(function ($q) {
            $q->where('is_public', true)
                ->orWhere('user_id', auth()->id());
        })
            ->whereNotNull('category')
            ->orderBy('created_at', 'desc')
            ->get();


        $this->categories = $this->items
            ->pluck('category')
            ->unique()
            ->values();

        $this->rooms = $user->rooms()->get();
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
        return view('livewire.pages.shopping.shopping', [
            'items' => $this->items,
            'categories' => $this->categories,
            'rooms' => $this->rooms,
        ])
            ->layout('layouts.app-sidebar', [
                'title' => 'Browse Items',
            ]);
    }


}
