<?php
class ItemsGrid extends Component
{
    public $items;
    public $roomId;

    public function addItemToRoom($itemId)
    {
        $room = Room::find($this->roomId);
        $item = Item::find($itemId);
        if(!$room || !$item) return;

        $existing = $room->items()->where('item_id', $itemId)->first();
        if($existing){
            $room->items()->updateExistingPivot($itemId, ['quantity' => $existing->pivot->quantity + 1]);
        } else {
            $room->items()->attach($itemId, ['quantity' => 1]);
        }

        if($item->price){
            $room->increment('spent', $item->price);
        }

        $room->load('items');
        $this->emitUp('roomUpdated');
    }

    public function render()
    {
        return view('livewire.partials.items-grid');
    }
}
