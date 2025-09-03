<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::create([
            'title' => 'Anniversary Sale',
            'subtitle' => '15% off Originals USD $750+ - Limited Time Offer',
            'button_text' => 'SHOP SALE',
            'button_url' => '/paintings',
            'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=1400&h=500&fit=crop',
            'background_color' => '#667eea',
            'text_color' => '#ffffff',
            'is_active' => true,
            'order' => 1,
        ]);

        Banner::create([
            'title' => 'New Artists',
            'subtitle' => 'Discover Amazing New Artists - Fresh Artwork Added Weekly',
            'button_text' => 'EXPLORE NOW',
            'button_url' => '/paintings',
            'image' => 'https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=1400&h=500&fit=crop',
            'background_color' => '#48bb78',
            'text_color' => '#ffffff',
            'is_active' => true,
            'order' => 2,
        ]);

        Banner::create([
            'title' => 'Free Shipping',
            'subtitle' => 'Free Shipping on All Orders Over $500 - Limited Time Offer',
            'button_text' => 'LEARN MORE',
            'button_url' => '/paintings',
            'image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=1400&h=500&fit=crop',
            'background_color' => '#ed8936',
            'text_color' => '#ffffff',
            'is_active' => true,
            'order' => 3,
        ]);
    }
}
