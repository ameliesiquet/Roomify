<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'firstname' => 'Test',
            'lastname' => 'User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'profile_photo_path' => 'profile-photos/profile.jpg',
            'password' => bcrypt('password')
        ]);
        User::factory()->create([
            'firstname' => 'Amélie',
            'lastname' => 'Siquet',
            'username' => 'amsel',
            'email' => 'am@ex.com',
            'profile_photo_path' => 'profile-photos/profile.jpg',
            'password' => bcrypt('#1Password')
        ]);
    }
}
