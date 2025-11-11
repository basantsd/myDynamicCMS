<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'category',
        'description',
        'preview_image',
        'schema',
        'default_values',
        'is_active',
        'usage_count',
    ];

    protected $casts = [
        'schema' => 'array',
        'default_values' => 'array',
        'is_active' => 'boolean',
        'usage_count' => 'integer',
    ];

    // Category constants
    const CATEGORY_HERO = 'hero';
    const CATEGORY_CONTENT = 'content';
    const CATEGORY_MEDIA = 'media';
    const CATEGORY_FORM = 'form';
    const CATEGORY_FEATURE = 'feature';

    /**
     * Get all available categories
     */
    public static function getCategories()
    {
        return [
            self::CATEGORY_HERO => 'Hero Sections',
            self::CATEGORY_CONTENT => 'Content Blocks',
            self::CATEGORY_MEDIA => 'Media Blocks',
            self::CATEGORY_FORM => 'Forms',
            self::CATEGORY_FEATURE => 'Features',
        ];
    }

    /**
     * Increment usage count
     */
    public function incrementUsage()
    {
        $this->increment('usage_count');
    }

    /**
     * Scope for active blocks
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for searching blocks
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%")
              ->orWhere('category', 'LIKE', "%{$search}%");
        });
    }

    /**
     * Scope for filtering by category
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get page sections using this block
     */
    public function sections()
    {
        return $this->hasMany(PageSection::class, 'custom_block_id');
    }
}
