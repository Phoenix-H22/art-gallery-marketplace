<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return redirect()->route('paintings.index');
        }

        $artworks = Artwork::query()
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('artist_name', 'LIKE', "%{$query}%")
                  ->orWhere('medium', 'LIKE', "%{$query}%")
                  ->orWhere('style', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('pages.search-results', [
            'artworks' => $artworks,
            'query' => $query,
            'totalResults' => $artworks->total()
        ]);
    }

    public function liveSearch(Request $request)
    {
        $query = $request->get('q');

        if (empty($query) || strlen($query) < 2) {
            return response()->json([]);
        }

        $artworks = Artwork::query()
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('artist_name', 'LIKE', "%{$query}%")
                  ->orWhere('medium', 'LIKE', "%{$query}%")
                  ->orWhere('style', 'LIKE', "%{$query}%");
            })
            ->select('id', 'title', 'artist_name', 'medium', 'price', 'image_url')
            ->limit(8)
            ->get();

        return response()->json($artworks);
    }
}
