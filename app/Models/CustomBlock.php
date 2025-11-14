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
        'color',
        'category',
        'description',
        'preview_image',
        'schema',
        'advanced_features',
        'action_settings',
        'default_values',
        'form_table_name',
        'html_template',
        'css_styles',
        'js_scripts',
        'traits_config',
        'dependencies',
        'block_version',
        'author',
        'tags',
        'thumbnail',
        'is_active',
        'usage_count',
    ];

    protected $casts = [
        'schema' => 'array',
        'advanced_features' => 'array',
        'action_settings' => 'array',
        'default_values' => 'array',
        'traits_config' => 'array',
        'dependencies' => 'array',
        'tags' => 'array',
        'is_active' => 'boolean',
        'usage_count' => 'integer',
    ];

    // Category constants
    const CATEGORY_HERO = 'hero';
    const CATEGORY_CONTENT = 'content';
    const CATEGORY_MEDIA = 'media';
    const CATEGORY_FORM = 'form';
    const CATEGORY_FEATURE = 'feature';
    const CATEGORY_SLIDER = 'slider';
    const CATEGORY_TABLE = 'table';
    const CATEGORY_LIST = 'list';
    const CATEGORY_BUTTON = 'button';

    /**
     * Get all available categories
     */
    public static function getCategories()
    {
        return [
            self::CATEGORY_HERO => 'Hero Sections',
            self::CATEGORY_CONTENT => 'Content Blocks',
            self::CATEGORY_MEDIA => 'Media Blocks',
            self::CATEGORY_SLIDER => 'Sliders',
            self::CATEGORY_TABLE => 'Tables',
            self::CATEGORY_FORM => 'Forms',
            self::CATEGORY_LIST => 'Lists',
            self::CATEGORY_BUTTON => 'Buttons & Actions',
            self::CATEGORY_FEATURE => 'Features',
        ];
    }

    /**
     * Get form submissions for this block
     */
    public function formSubmissions()
    {
        return $this->hasManyThrough(
            FormSubmission::class,
            PageSection::class,
            'custom_block_id',
            'page_section_id'
        );
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

    /**
     * Get block usage records
     */
    public function usageRecords()
    {
        return $this->hasMany(CustomBlockUsage::class, 'block_id');
    }

    /**
     * Get block variants
     */
    public function variants()
    {
        return $this->hasMany(CustomBlockVariant::class, 'block_id');
    }
}
