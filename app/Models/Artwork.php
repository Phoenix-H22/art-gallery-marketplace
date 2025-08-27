<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'artist_name',
        'medium',
        'dimensions',
        'price',
        'image_url',
        'image_file',
        'description',
        'category_id',
        'user_id',
        'is_ready_to_hang',
        'year_created',
        'style',
        'condition',
        'location',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_ready_to_hang' => 'boolean',
        'year_created' => 'integer',
    ];

    /**
     * Get the category that owns the artwork.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user (artist) that owns the artwork.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the videos related to this artwork (through the same artist).
     */
    public function videos()
    {
        return $this->hasMany(Video::class, 'user_id', 'user_id');
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 0);
    }

    /**
     * Get the formatted dimensions.
     */
    public function getFormattedDimensionsAttribute()
    {
        return $this->dimensions;
    }

    /**
     * Get the artist name (from user if available, otherwise from artist_name field).
     */
    public function getArtistNameAttribute($value)
    {
        return $this->user ? $this->user->name : $value;
    }

    /**
     * Get the image URL for display.
     */
    public function getImageUrlAttribute($value)
    {
        // If it's already a full URL, return it
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        // If it's a file path, return the storage URL
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            return asset('storage/' . $value);
        }

        return $value;
    }

    /**
     * Get the display image URL (prioritizes uploaded file over URL).
     */
    public function getDisplayImageUrlAttribute()
    {
        // If there's an uploaded file, use that
        if ($this->image_file) {
            return asset('storage/' . $this->image_file);
        }

        // Otherwise use the URL
        return $this->image_url;
    }
}
