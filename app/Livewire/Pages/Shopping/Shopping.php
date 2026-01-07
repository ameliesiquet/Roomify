<?php

namespace App\Livewire\Pages\Shopping;

use App\Models\Item;
use Livewire\Component;

class Shopping extends Component
{
    public $items;

    public function mount()
    {
        $this->items = Item::where(function ($q) {
            $q->where('is_public', true)
                ->orWhere('user_id', auth()->id());
        })
            ->orderBy('created_at', 'desc')
            ->get();

        $this->categories = $this->items
            ->pluck('category')
            ->unique()
            ->values();
    }
    public function render()
    {
        return view('livewire.pages.shopping', [
            'items' => $this->items,
            'categories' => $this->categories,
        ])
            ->layout('layouts.app-sidebar', [
                'title' => 'Browse Items',
            ]);
    }


}
