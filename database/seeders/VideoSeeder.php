<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing artists and categories
        $artist1 = User::where('email', 'sarah.johnson@example.com')->first();
        $artist2 = User::where('email', 'michael.chen@example.com')->first();
        $artist3 = User::where('email', 'emma.rodriguez@example.com')->first();

        $abstractCategory = Category::where('slug', 'abstract')->first();
        $realismCategory = Category::where('slug', 'realism')->first();
        $contemporaryCategory = Category::where('slug', 'contemporary')->first();

        if (!$artist1 || !$artist2 || !$artist3 || !$abstractCategory) {
            $this->command->info('Required artists or categories not found. Skipping video creation.');
            return;
        }

        $videos = [
            [
                'title' => 'Abstract Painting Process',
                'description' => 'Watch the creation of a beautiful abstract painting from start to finish.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1549887534-1541e9326642?w=400',
                'duration' => 180, // 3 minutes
                'user_id' => $artist1->id,
                'category_id' => $abstractCategory->id,
                'is_featured' => true,
            ],
            [
                'title' => 'Realistic Portrait Techniques',
                'description' => 'Learn the techniques used to create realistic portrait paintings.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc9e?w=400',
                'duration' => 240, // 4 minutes
                'user_id' => $artist2->id,
                'category_id' => $realismCategory->id,
                'is_featured' => false,
            ],
            [
                'title' => 'Contemporary Art Studio Tour',
                'description' => 'Take a tour of a contemporary artist\'s studio and see their creative process.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=400',
                'duration' => 300, // 5 minutes
                'user_id' => $artist3->id,
                'category_id' => $contemporaryCategory->id,
                'is_featured' => true,
            ],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }

        $this->command->info('Sample videos created successfully!');
    }
}
