<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Artwork;
use App\Models\User;

class ArtworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing artists
        $artist1 = User::where('email', 'sarah.johnson@example.com')->first();
        $artist2 = User::where('email', 'michael.chen@example.com')->first();
        $artist3 = User::where('email', 'emma.rodriguez@example.com')->first();
        $artist4 = User::where('email', 'david.thompson@example.com')->first();

        // Get existing categories
        $abstractCategory = Category::where('slug', 'abstract')->first();
        $realismCategory = Category::where('slug', 'realism')->first();
        $impressionismCategory = Category::where('slug', 'impressionism')->first();
        $contemporaryCategory = Category::where('slug', 'contemporary')->first();
        $landscapeCategory = Category::where('slug', 'landscape')->first();
        $portraitCategory = Category::where('slug', 'portrait')->first();

        // Check if we have the required data
        if (!$artist1 || !$artist2 || !$artist3 || !$artist4 || !$abstractCategory) {
            $this->command->info('Required artists or categories not found. Skipping artwork creation.');
            return;
        }

        // Create artworks with user associations
        $artworks = [
            [
                'title' => 'Abstract Harmony',
                'artist_name' => 'Sarah Johnson',
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '36" x 48"',
                'price' => 2500.00,
                'image_file' => 'artworks/abstract-harmony.jpg',
                'description' => 'A vibrant abstract composition exploring color theory and emotional expression.',
                'category_id' => $abstractCategory->id,
                'user_id' => $artist1->id,
                'is_ready_to_hang' => true,
                'year_created' => 2023,
                'style' => 'Abstract',
                'condition' => 'Excellent',
                'location' => 'New York, NY',
            ],
            [
                'title' => 'Urban Landscape',
                'artist_name' => 'Michael Chen',
                'medium' => 'Oil on Canvas',
                'dimensions' => '24" x 36"',
                'price' => 1800.00,
                'image_file' => 'artworks/urban-landscape.jpg',
                'description' => 'A realistic portrayal of city life with dramatic lighting and urban architecture.',
                'category_id' => $realismCategory->id,
                'user_id' => $artist2->id,
                'is_ready_to_hang' => true,
                'year_created' => 2022,
                'style' => 'Realism',
                'condition' => 'Excellent',
                'location' => 'San Francisco, CA',
            ],
            [
                'title' => 'Contemporary Fusion',
                'artist_name' => 'Emma Rodriguez',
                'medium' => 'Mixed Media on Canvas',
                'dimensions' => '48" x 60"',
                'price' => 3200.00,
                'image_file' => 'artworks/contemporary-fusion.jpg',
                'description' => 'A contemporary piece blending traditional techniques with modern materials.',
                'category_id' => $contemporaryCategory->id,
                'user_id' => $artist3->id,
                'is_ready_to_hang' => false,
                'year_created' => 2024,
                'style' => 'Contemporary',
                'condition' => 'Excellent',
                'location' => 'Los Angeles, CA',
            ],
        ];

        foreach ($artworks as $artworkData) {
            Artwork::create($artworkData);
        }

        // Update artwork counts for categories
        $categories = Category::all();
        foreach ($categories as $category) {
            $category->artworks_count = $category->artworks()->count();
            $category->save();
        }
    }
}
