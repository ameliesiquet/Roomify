<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'am@ex.com')->firstOrFail();

        $this->rooms = $user->rooms()->get();


        Room::create([
            'user_id' => $user->id,
            'name' => 'Example',
            'budget' => 2400.00,
            'spent' => 800.00,
            'colors' => json_encode(['#2D3748', '#8B4513', '#4A5568', '#60A5FA']),
            'notes' => 'Modern minimalist design with warm tones',
            'todo_list' => json_encode([
                ['text' => 'Choose paint or wallpaper', 'completed' => false],
                ['text' => 'Find a new bed', 'completed' => true],
                ['text' => 'Find a rug in the right size', 'completed' => true],
                ['text' => 'Choose bedside lamps', 'completed' => true],
                ['text' => 'Set a budget for the bedroom', 'completed' => true],
            ]),
        ]);

        Room::create([
            'user_id' => $user->id,
            'name' => 'Living Room',
            'budget' => 3000.00,
            'spent' => 1200.00,
        ]);

        Room::create([
            'user_id' => $user->id,
            'name' => 'Kitchen',
            'budget' => 5000.00,
            'spent' => 2500.00,
        ]);
    }
}
