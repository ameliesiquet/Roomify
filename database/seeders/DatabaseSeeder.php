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
        User::factory()->create([
            'firstname' => 'Test',
            'lastname' => 'User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);
        User::factory()->create([
            'firstname' => 'Amelie',
            'lastname' => 'Siquet',
            'username' => 'amsel',
            'email' => 'am@ex.com',
            'password' => bcrypt('password')
        ]);
    }
}
