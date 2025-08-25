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
}
