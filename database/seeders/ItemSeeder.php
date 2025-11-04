<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $dataPath = database_path('data');
        $files = File::files($dataPath);

        if (empty($files)) {
            $this->command->error("No JSON files found in /database/data/");
            return;
        }

        foreach ($files as $file) {
            if ($file->getExtension() !== 'json') {
                continue;
            }

            $category = ucfirst(str_replace('.json', '', $file->getFilename()));
            $this->command->info("Importing items from {$category}.json ...");

            $items = json_decode(File::get($file->getPathname()), true);

            if (!is_array($items)) {
                $this->command->error("Invalid JSON format in {$file->getFilename()}");
                continue;
            }

            foreach ($items as $item) {
                $item['category'] = $item['category'] ?? strtolower($category);
                Item::create($item);
            }

            $this->command->info("✅ Imported " . count($items) . " items from {$file->getFilename()}");
        }
    }
}
