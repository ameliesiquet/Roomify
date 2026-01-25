<?php

namespace App\Livewire\Pages\Shopping;

use App\Models\Item;
use App\Models\Room;
use Livewire\Component;
use Livewire\WithFileUploads;

class Shopping extends Component
{
    use WithFileUploads;

    public $items;
    public $categories;
    public $rooms;

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

    public function openAddModal()
    {
        $this->showAddModal = true;
    }

    public function closeAddModal()
    {
        $this->showAddModal = false;
        $this->reset(['title', 'description', 'price', 'size', 'category', 'image', 'item_url', 'shop_link', 'is_public']);
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'size' => 'nullable|string|max:50',
            'category' => 'required|string',
            'image' => 'required|image|max:2048',
            'item_url' => 'required|url|max:2000',
            'shop_link' => 'nullable|url',
        ];
    }

    protected function messages()
    {
        return [
            'title.required' => 'Please enter a title.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.required' => 'Please enter a description.',
            'price.required' => 'Please enter a price.',
            'price.numeric' => 'Price must be a number.',
            'price.min' => 'Price must be at least 0.',
            'category.required' => 'Please select a category.',
            'image.required' => 'Please upload an image.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be larger than 2MB.',
            'item_url.required' => 'Please enter an item URL.',
            'item_url.url' => 'Item URL must be a valid URL.',
            'shop_link.url' => 'Shop link must be a valid URL.',
        ];
    }

    public function createItem()
    {
        $this->validate();

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
            'item_url' => $this->item_url, // NEU
            'shop_link' => $this->shop_link,
            'is_public' => $this->is_public,
        ]);

        session()->flash('message', 'Item "' . $this->title . '" was successfully created!');

        $this->closeAddModal();
        $this->mount();
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
