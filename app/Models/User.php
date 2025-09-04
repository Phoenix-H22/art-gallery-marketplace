<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'bio',
        'location',
        'avatar',
        'main_video_id',
        'featured_video_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the artworks for this user.
     */
    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }

    /**
     * Get the videos for this user.
     */
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Check if user is an artist.
     */
    public function isArtist()
    {
        return $this->role === 'artist';
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    /**
     * Get the user's avatar URL.
     */
    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return 'https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?w=150&h=150&fit=crop';
        }

        // If it's already a full URL, return it
        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }

        // If it's a file path, return the storage URL
        return asset('storage/' . $this->avatar);
    }

    /**
     * Get the user's main video.
     */
    public function mainVideo()
    {
        return $this->belongsTo(Video::class, 'main_video_id');
    }

    /**
     * Get the user's featured video.
     */
    public function featuredVideo()
    {
        return $this->belongsTo(Video::class, 'featured_video_id');
    }
}
