<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured artworks for hero carousel
        $featuredArtworks = Artwork::inRandomOrder()->limit(3)->get();
        
        // Get categories for category pills
        $categories = Category::withCount('artworks')->get();
        
        return view('pages.home', compact('featuredArtworks', 'categories'));
    }
}
