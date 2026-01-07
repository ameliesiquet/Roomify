<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Item;

class ItemSeeder extends Seeder
{

    protected $categoryMap = [
        'bed' => 'furniture',
        'chair' => 'furniture',
        'table' => 'furniture',
        'cabinet' => 'furniture',
        'sofa' => 'furniture',
        'cushion' => 'textiles',
        'carpet' => 'textiles',
        'blanket' => 'textiles',
        'deco' => 'decoration',
        'vase' => 'decoration',
        'sculpture' => 'decoration',
        'wall_art' => 'decoration',
        'lamp' => 'lighting',
        'electronics' => 'electronics',
        'tv' => 'electronics',
        'projector' => 'electronics',
        'other' => 'other',
    ];

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

            $originalCategory = strtolower(str_replace('.json', '', $file->getFilename()));
            $this->command->info("Importing items from {$originalCategory}.json ...");

            $items = json_decode(File::get($file->getPathname()), true);

            if (!is_array($items)) {
                $this->command->error("Invalid JSON format in {$file->getFilename()}");
                continue;
            }

            foreach ($items as $item) {
                $mainCategory = $this->categoryMap[$item['category'] ?? $originalCategory] ?? 'other';
                $item['category'] = $mainCategory;

                $tags = [];
                if (isset($item['category']) && $originalCategory !== $mainCategory) {
                    $tags[] = $originalCategory;
                }
                if (isset($item['tags']) && is_array($item['tags'])) {
                    $tags = array_merge($tags, $item['tags']);
                }
                $item['tags'] = !empty($tags) ? json_encode($tags) : null;

                $item['room_id'] = $item['room_id'] ?? null;

                Item::create($item);
            }

            $this->command->info("✅ Imported " . count($items) . " items from {$file->getFilename()}");
        }
    }
}
