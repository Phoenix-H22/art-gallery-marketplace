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
        // Create some users (artists)
        $artist1 = User::create([
            'name' => 'Magdalena Krzak',
            'email' => 'magdalena@example.com',
            'password' => bcrypt('password'),
            'role' => 'artist',
            'bio' => 'MAGDALENA KRZAK was born in Tarnów, Poland. After graduating from Art School in Tarnów she continued her education at the University in Rzeszow. Her paintings present a unique combination of an abstract, figurative forms and drawing.',
            'location' => 'Chicago, IL, United States',
        ]);

        $artist2 = User::create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah@example.com',
            'password' => bcrypt('password'),
            'role' => 'artist',
            'bio' => 'Sarah Johnson is a contemporary artist known for her vibrant abstract paintings that explore themes of nature and human emotion.',
            'location' => 'New York, NY, United States',
        ]);

        $artist3 = User::create([
            'name' => 'Carlos Martinez',
            'email' => 'carlos@example.com',
            'password' => bcrypt('password'),
            'role' => 'artist',
            'bio' => 'Carlos Martinez is a Spanish artist whose work focuses on urban landscapes and modern city life.',
            'location' => 'Madrid, Spain',
        ]);

        // Create categories
        $categories = [
            ['name' => 'Abstract Art', 'slug' => 'abstract-art', 'description' => 'Non-representational art forms'],
            ['name' => 'Oil Paintings', 'slug' => 'oil-paintings', 'description' => 'Traditional oil on canvas works'],
            ['name' => 'Landscapes', 'slug' => 'landscapes', 'description' => 'Natural scenery and outdoor scenes'],
            ['name' => 'Portraits', 'slug' => 'portraits', 'description' => 'Human and animal portraits'],
            ['name' => 'Modern Art', 'slug' => 'modern-art', 'description' => 'Contemporary artistic expressions'],
            ['name' => 'Sculpture', 'slug' => 'sculpture', 'description' => 'Three-dimensional art forms'],
            ['name' => 'Acrylic Paintings', 'slug' => 'acrylic-paintings', 'description' => 'Acrylic medium artworks'],
            ['name' => 'Watercolor', 'slug' => 'watercolor', 'description' => 'Water-based paint artworks'],
            ['name' => 'Curated Collections', 'slug' => 'curated-collections', 'description' => 'Carefully selected art pieces'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Get category references
        $abstractCategory = Category::where('slug', 'abstract-art')->first();
        $oilCategory = Category::where('slug', 'oil-paintings')->first();
        $landscapeCategory = Category::where('slug', 'landscapes')->first();
        $modernCategory = Category::where('slug', 'modern-art')->first();
        $acrylicCategory = Category::where('slug', 'acrylic-paintings')->first();

        // Create artworks with user associations
        $artworks = [
            [
                'title' => 'Fruitful Day',
                'artist_name' => 'Magdalena Krzak',
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '36 x 48 in',
                'price' => 3868.00,
                'image_url' => 'https://images.unsplash.com/photo-1549887534-1541e9326642?w=800',
                'description' => 'Original acrylic painting on canvas. Artwork is signed.',
                'category_id' => $acrylicCategory->id,
                'user_id' => $artist1->id,
                'is_ready_to_hang' => false,
                'year_created' => 2022,
                'style' => 'Abstract, Expressionism, Figurative',
                'condition' => 'Excellent',
                'location' => 'United States',
            ],
            [
                'title' => 'Swimmer',
                'artist_name' => 'Magdalena Krzak',
                'medium' => 'Oil on Canvas',
                'dimensions' => '24 x 20 in',
                'price' => 948.00,
                'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc9e?w=800',
                'description' => 'A beautiful oil painting depicting a swimmer in motion.',
                'category_id' => $oilCategory->id,
                'user_id' => $artist1->id,
                'is_ready_to_hang' => true,
                'year_created' => 2023,
                'style' => 'Figurative, Realism',
                'condition' => 'Excellent',
                'location' => 'United States',
            ],
            [
                'title' => 'By The Pool',
                'artist_name' => 'Magdalena Krzak',
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '30 x 30 in',
                'price' => 1545.00,
                'image_url' => 'https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=800',
                'description' => 'A serene scene by the pool with vibrant colors.',
                'category_id' => $acrylicCategory->id,
                'user_id' => $artist1->id,
                'is_ready_to_hang' => true,
                'year_created' => 2023,
                'style' => 'Abstract, Expressionism',
                'condition' => 'Excellent',
                'location' => 'United States',
            ],
            [
                'title' => 'Garden Girl',
                'artist_name' => 'Magdalena Krzak',
                'medium' => 'Oil on Canvas',
                'dimensions' => '30 x 40 in',
                'price' => 1984.00,
                'image_url' => 'https://images.unsplash.com/photo-1578321272176-b7bbc0679853?w=800',
                'description' => 'A beautiful portrait of a girl in a garden setting.',
                'category_id' => $oilCategory->id,
                'user_id' => $artist1->id,
                'is_ready_to_hang' => false,
                'year_created' => 2022,
                'style' => 'Figurative, Impressionism',
                'condition' => 'Excellent',
                'location' => 'United States',
            ],
            [
                'title' => 'Urban Abstract',
                'artist_name' => 'Sarah Johnson',
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '40 x 60 in',
                'price' => 2500.00,
                'image_url' => 'https://images.unsplash.com/photo-1536924940846-227afb31e2a5?w=800',
                'description' => 'A vibrant abstract interpretation of urban life.',
                'category_id' => $abstractCategory->id,
                'user_id' => $artist2->id,
                'is_ready_to_hang' => true,
                'year_created' => 2023,
                'style' => 'Abstract, Modern',
                'condition' => 'Excellent',
                'location' => 'United States',
            ],
            [
                'title' => 'Mountain Vista',
                'artist_name' => 'Sarah Johnson',
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
            [
                'title' => 'Modern Composition',
                'artist_name' => 'Carlos Martinez',
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '48 x 48 in',
                'price' => 1800.00,
                'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc9e?w=800',
                'description' => 'A modern geometric composition with bold colors.',
                'category_id' => $modernCategory->id,
                'user_id' => $artist3->id,
                'is_ready_to_hang' => true,
                'year_created' => 2023,
                'style' => 'Modern, Geometric',
                'condition' => 'Excellent',
                'location' => 'Spain',
            ],
            [
                'title' => 'City Lights',
                'artist_name' => 'Carlos Martinez',
                'medium' => 'Oil on Canvas',
                'dimensions' => '40 x 30 in',
                'price' => 2200.00,
                'image_url' => 'https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=800',
                'description' => 'A vibrant cityscape with glowing lights.',
                'category_id' => $landscapeCategory->id,
                'user_id' => $artist3->id,
                'is_ready_to_hang' => false,
                'year_created' => 2022,
                'style' => 'Urban, Impressionism',
                'condition' => 'Excellent',
                'location' => 'Spain',
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
