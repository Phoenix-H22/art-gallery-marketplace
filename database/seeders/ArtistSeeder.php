<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artists = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'password' => Hash::make('password'),
                'role' => 'artist',
                'bio' => 'Contemporary abstract artist specializing in vibrant color compositions.',
                'location' => 'New York, NY',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'michael.chen@example.com',
                'password' => Hash::make('password'),
                'role' => 'artist',
                'bio' => 'Realist painter with a focus on urban landscapes and city life.',
                'location' => 'San Francisco, CA',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Emma Rodriguez',
                'email' => 'emma.rodriguez@example.com',
                'password' => Hash::make('password'),
                'role' => 'artist',
                'bio' => 'Impressionist artist capturing the beauty of nature and light.',
                'location' => 'Miami, FL',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'David Thompson',
                'email' => 'david.thompson@example.com',
                'password' => Hash::make('password'),
                'role' => 'artist',
                'bio' => 'Portrait artist specializing in capturing human emotion and character.',
                'location' => 'Chicago, IL',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($artists as $artist) {
            User::firstOrCreate(
                ['email' => $artist['email']],
                $artist
            );
        }

        $this->command->info('Sample artists created successfully!');
    }
}
