<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'video_file',
        'thumbnail_file',
        'duration',
        'user_id',
        'category_id',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'duration' => 'integer',
    ];

    /**
     * Get the user (artist) that owns the video.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the video.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the formatted duration.
     */
    public function getFormattedDurationAttribute()
    {
        if (!$this->duration) {
            return 'Unknown';
        }

        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;

        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    /**
     * Get the video URL for display.
     */
    public function getVideoUrlAttribute()
    {
        if ($this->video_file) {
            return asset('storage/' . $this->video_file);
        }

        return null;
    }

    /**
     * Get the thumbnail URL for display.
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail_file) {
            return asset('storage/' . $this->thumbnail_file);
        }

        return asset('images/placeholder-video.jpg');
    }

    /**
     * Get the display thumbnail URL (prioritizes uploaded file over URL).
     */
    public function getDisplayThumbnailUrlAttribute()
    {
        return $this->thumbnail_url;
    }
}
