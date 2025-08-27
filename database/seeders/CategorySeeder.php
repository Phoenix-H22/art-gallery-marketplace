<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Abstract',
                'slug' => 'abstract',
                'description' => 'Abstract art that does not attempt to represent external reality.',
            ],
            [
                'name' => 'Realism',
                'slug' => 'realism',
                'description' => 'Art that represents subjects as they appear in everyday life.',
            ],
            [
                'name' => 'Impressionism',
                'slug' => 'impressionism',
                'description' => 'Art characterized by visible brush strokes and emphasis on light.',
            ],
            [
                'name' => 'Contemporary',
                'slug' => 'contemporary',
                'description' => 'Art produced in the present time period.',
            ],
            [
                'name' => 'Landscape',
                'slug' => 'landscape',
                'description' => 'Art depicting natural scenery such as mountains, valleys, trees, rivers, and forests.',
            ],
            [
                'name' => 'Portrait',
                'slug' => 'portrait',
                'description' => 'Art representing a person, group of people, or an animal.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $this->command->info('Categories seeded successfully!');
    }
}
