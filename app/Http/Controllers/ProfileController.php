<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artwork;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the artist profile page.
     */
    public function show($id)
    {
        $profileUser = User::where('id', $id)
            ->where('role', 'artist')
            ->with(['artworks' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }, 'mainVideo'])
            ->firstOrFail();

        $artworks = $profileUser->artworks()->paginate(12);

        // Get videos for this artist
        $videos = $profileUser->videos()->orderBy('is_featured', 'desc')->get();

        return view('pages.profile', compact('profileUser', 'artworks', 'videos'));
    }

    /**
     * Show the current user's profile.
     */
    public function myProfile()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $profileUser = auth()->user();
        $artworks = $profileUser->artworks()->paginate(12);

        // Get videos for this artist
        $videos = $profileUser->videos()->orderBy('is_featured', 'desc')->get();

        return view('pages.profile', compact('profileUser', 'artworks', 'videos'));
    }
}
