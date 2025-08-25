<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    public function index(Request $request)
    {
        $query = Artwork::with('category');

        // Apply filters
        if ($request->filled('category')) {
            $categories = $request->category;
            // Handle both single category and array of categories
            if (!is_array($categories)) {
                $categories = [$categories];
            }

            // Filter out any empty values
            $categories = array_filter($categories);

            if (!empty($categories)) {
                $query->whereHas('category', function ($q) use ($categories) {
                    $q->whereIn('slug', $categories);
                });
            }
        }

        if ($request->filled('medium')) {
            $mediums = $request->medium;
            if (!is_array($mediums)) {
                $mediums = [$mediums];
            }
            // Filter out any empty values
            $mediums = array_filter($mediums);

            if (!empty($mediums)) {
                $query->whereIn('medium', $mediums);
            }
        }

        if ($request->filled('style')) {
            $styles = $request->style;
            if (!is_array($styles)) {
                $styles = [$styles];
            }
            // Filter out any empty values
            $styles = array_filter($styles);

            if (!empty($styles)) {
                $query->whereIn('style', $styles);
            }
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Apply sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'oldest':
                $query->orderBy('year_created', 'asc');
                break;
            default:
                $query->orderBy('year_created', 'desc');
        }

        // Get unique values for filters
        $mediums = Artwork::distinct()->pluck('medium')->filter();
        $styles = Artwork::distinct()->pluck('style')->filter();
        $categories = Category::withCount('artworks')->get();

        // Paginate results
        $artworks = $query->paginate(12);

        return view('pages.paintings', compact('artworks', 'categories', 'mediums', 'styles'));
    }

    public function show($id)
    {
        $artwork = Artwork::with('category')->findOrFail($id);

        // Get related artworks (same category)
        $relatedArtworks = Artwork::where('category_id', $artwork->category_id)
            ->where('id', '!=', $artwork->id)
            ->limit(4)
            ->get();

        // Get visually similar artworks (same medium or style)
        $similarArtworks = Artwork::where(function ($query) use ($artwork) {
            $query->where('medium', $artwork->medium)
                  ->orWhere('style', $artwork->style);
        })
        ->where('id', '!=', $artwork->id)
        ->where('category_id', '!=', $artwork->category_id)
        ->limit(4)
        ->get();

        // Get recommended artworks (different category, different artist)
        $recommendedArtworks = Artwork::where('category_id', '!=', $artwork->category_id)
            ->where('artist_name', '!=', $artwork->artist_name)
            ->where('id', '!=', $artwork->id)
            ->limit(4)
            ->get();

        return view('pages.product-detail', compact('artwork', 'relatedArtworks', 'similarArtworks', 'recommendedArtworks'));
    }
}
