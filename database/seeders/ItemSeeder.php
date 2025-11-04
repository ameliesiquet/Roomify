<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/items.json');
        if (!File::exists($path)) {
            $this->command->error("⚠️  items.json file not found!");
            return;
        }

        $items = json_decode(File::get($path), true);

        foreach ($items as $item) {
            Item::create($item);
        }

        $this->command->info('✅ Items imported successfully!');
    }
}
