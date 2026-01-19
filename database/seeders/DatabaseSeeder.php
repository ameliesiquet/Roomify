<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment('local')) {
            $this->call([
                UserSeeder::class,
                RoomSeeder::class,
            ]);
        }

        $this->call([
            ItemSeeder::class,
        ]);
    }
}
