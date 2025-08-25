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
            }])
            ->firstOrFail();

        $artworks = $profileUser->artworks()->paginate(12);

        return view('pages.profile', compact('profileUser', 'artworks'));
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

        return view('pages.profile', compact('profileUser', 'artworks'));
    }
}
