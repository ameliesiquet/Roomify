<?php

namespace App\Livewire\Pages\Shopping;

use App\Models\Item;
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
    public function render()
    {
        return view('livewire.pages.shopping', [
            'items' => $this->items,
            'categories' => $this->categories,
            'rooms' => $this->rooms,
        ])
            ->layout('layouts.app-sidebar', [
                'title' => 'Browse Items',
            ]);
    }


}
