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
                'video_file' => 'videos/abstract-painting-process.mp4',
                'thumbnail_file' => 'video-thumbnails/abstract-painting-thumbnail.jpg',
                'duration' => 180, // 3 minutes
                'user_id' => $artist1->id,
                'category_id' => $abstractCategory->id,
                'is_featured' => true,
            ],
            [
                'title' => 'Realistic Portrait Techniques',
                'description' => 'Learn the techniques used to create realistic portrait paintings.',
                'video_file' => 'videos/realistic-portrait-techniques.mp4',
                'thumbnail_file' => 'video-thumbnails/realistic-portrait-thumbnail.jpg',
                'duration' => 240, // 4 minutes
                'user_id' => $artist2->id,
                'category_id' => $realismCategory->id,
                'is_featured' => false,
            ],
            [
                'title' => 'Contemporary Art Studio Tour',
                'description' => 'Take a tour of a contemporary artist\'s studio and see their creative process.',
                'video_file' => 'videos/contemporary-studio-tour.mp4',
                'thumbnail_file' => 'video-thumbnails/contemporary-studio-thumbnail.jpg',
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
