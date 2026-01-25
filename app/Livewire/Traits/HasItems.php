<?php
namespace App\Livewire\Traits;

use App\Models\Item;
use App\Models\Room;

trait HasItems
{
    public $showAddModal = false;

    public $title = '';
    public $description = '';
    public $price = '';
    public $size = '';
    public $category = '';
    public $image = null;
    public $item_url = '';
    public $shop_link = '';
    public $is_public = false;

    public function openAddModal()
    {
        $this->showAddModal = true;
    }

    public function closeAddModal()
    {
        $this->showAddModal = false;
        $this->reset(['title', 'description', 'price', 'size', 'category', 'image', 'item_url', 'shop_link', 'is_public']);
    }

    public function createItem()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'size' => 'nullable|string|max:50',
            'category' => 'required|string',
            'image' => 'required|image|max:2048',
            'item_url' => 'required|url|max:2000',
            'shop_link' => 'nullable|url',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('items', 'public');
        }

        $item = Item::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'size' => $this->size,
            'category' => $this->category,
            'image_url' => $imagePath ? asset('storage/' . $imagePath) : null,
            'item_url' => $this->item_url,
            'shop_link' => $this->shop_link,
            'is_public' => $this->is_public,
        ]);

        session()->flash('message', 'Item "' . $this->title . '" was successfully created!');

        $this->closeAddModal();
    }

    public function addItemToRoom($itemId, $roomId)
    {
        $room = Room::find($roomId);
        $item = Item::find($itemId);
        if (!$room || !$item) return;

        $existing = $room->items()->where('item_id', $itemId)->first();
        if ($existing) {
            $room->items()->updateExistingPivot($itemId, ['quantity' => $existing->pivot->quantity + 1]);
        } else {
            $room->items()->attach($itemId, ['quantity' => 1]);
        }

        if ($item->price) $room->increment('spent', $item->price);
        $room->load('items');
    }
}
