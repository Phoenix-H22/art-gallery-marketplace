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
    public function getImageUrlAttribute()
    {
        if ($this->image_file) {
            return asset('storage/' . $this->image_file);
        }

        return asset('images/placeholder-artwork.jpg');
    }

    /**
     * Get the display image URL (prioritizes uploaded file over URL).
     */
    public function getDisplayImageUrlAttribute()
    {
        return $this->image_url;
    }
}
