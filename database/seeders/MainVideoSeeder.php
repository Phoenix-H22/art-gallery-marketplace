<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Video;

class MainVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all artist users
        $artists = User::where('role', 'artist')->get();

        foreach ($artists as $artist) {
            // Get the first video for this artist
            $video = Video::where('user_id', $artist->id)->first();

            if ($video) {
                // Set this video as the main video for the artist
                $artist->update(['main_video_id' => $video->id]);
                echo "Set main video for artist: {$artist->name} (ID: {$artist->id})\n";
            } else {
                echo "No videos found for artist: {$artist->name} (ID: {$artist->id})\n";
            }
        }
    }
}
