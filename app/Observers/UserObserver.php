<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\Room;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $room = Room::create([
            'user_id' => $user->id,
            'name' => 'Example',
            'budget' => 2400,
            'spent' => 800,
            'colors' => ['#2D3748', '#8B4513', '#4A5568', '#60A5FA'],
            'notes' => 'This is an example room to help you get started.',
            'todo_list' => [
                ['text' => 'Create your own room', 'completed' => false],
                ['text' => 'Add items to a room', 'completed' => false],
            ],
            'is_example' => true,
        ]);

        $items = Item::inRandomOrder()->take(4)->get();

        foreach ($items as $item) {
            $room->items()->attach($item->id, [
                'quantity' => rand(1, 2),
            ]);
        }
    }



    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
