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
                'artist_name' => $artist1->name,
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '36 x 48 in',
                'price' => 3868.00,
                'image_url' => 'https://images.unsplash.com/photo-1549887534-1541e9326642?w=800',
                'description' => 'Original acrylic painting on canvas. Artwork is signed.',
                'category_id' => $abstractCategory->id,
                'user_id' => $artist1->id,
                'is_ready_to_hang' => false,
                'year_created' => 2022,
                'style' => 'Abstract, Expressionism',
                'condition' => 'Excellent',
                'location' => 'United States',
            ],
            [
                'title' => 'Urban Portrait',
                'artist_name' => $artist2->name,
                'medium' => 'Oil on Canvas',
                'dimensions' => '24 x 20 in',
                'price' => 948.00,
                'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc9e?w=800',
                'description' => 'A beautiful oil painting depicting urban life.',
                'category_id' => $realismCategory->id,
                'user_id' => $artist2->id,
                'is_ready_to_hang' => true,
                'year_created' => 2023,
                'style' => 'Realism',
                'condition' => 'Excellent',
                'location' => 'United States',
            ],
            [
                'title' => 'Sunset Impression',
                'artist_name' => $artist3->name,
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '30 x 30 in',
                'price' => 1545.00,
                'image_url' => 'https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=800',
                'description' => 'A serene sunset scene with vibrant colors.',
                'category_id' => $impressionismCategory->id,
                'user_id' => $artist3->id,
                'is_ready_to_hang' => true,
                'year_created' => 2023,
                'style' => 'Impressionism',
                'condition' => 'Excellent',
                'location' => 'United States',
            ],
            [
                'title' => 'Modern Portrait',
                'artist_name' => $artist4->name,
                'medium' => 'Oil on Canvas',
                'dimensions' => '30 x 40 in',
                'price' => 1984.00,
                'image_url' => 'https://images.unsplash.com/photo-1578321272176-b7bbc0679853?w=800',
                'description' => 'A beautiful portrait with modern styling.',
                'category_id' => $portraitCategory->id,
                'user_id' => $artist4->id,
                'is_ready_to_hang' => false,
                'year_created' => 2022,
                'style' => 'Portrait, Contemporary',
                'condition' => 'Excellent',
                'location' => 'United States',
            ],
            [
                'title' => 'Contemporary Abstract',
                'artist_name' => $artist1->name,
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '40 x 60 in',
                'price' => 2500.00,
                'image_url' => 'https://images.unsplash.com/photo-1536924940846-227afb31e2a5?w=800',
                'description' => 'A vibrant contemporary abstract composition.',
                'category_id' => $contemporaryCategory->id,
                'user_id' => $artist1->id,
                'is_ready_to_hang' => true,
                'year_created' => 2023,
                'style' => 'Abstract, Contemporary',
                'condition' => 'Excellent',
                'location' => 'United States',
            ],
            [
                'title' => 'Mountain Landscape',
                'artist_name' => $artist2->name,
                'medium' => 'Oil on Canvas',
                'dimensions' => '36 x 48 in',
                'price' => 3200.00,
                'image_url' => 'https://images.unsplash.com/photo-1549887534-1541e9326642?w=800',
                'description' => 'A breathtaking landscape of mountain ranges.',
                'category_id' => $landscapeCategory->id,
                'user_id' => $artist2->id,
                'is_ready_to_hang' => true,
                'year_created' => 2022,
                'style' => 'Landscape, Realism',
                'condition' => 'Excellent',
                'location' => 'United States',
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
