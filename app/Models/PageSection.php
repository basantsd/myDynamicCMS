<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'section_type',
        'order',
        'content',
        'is_active',
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    // Section type constants
    const TYPE_HERO_BANNER = 'hero_banner';
    const TYPE_RICH_CONTENT = 'rich_content';
    const TYPE_DATA_TABLE = 'data_table';
    const TYPE_IMAGE_GALLERY = 'image_gallery';
    const TYPE_SERVICES_GRID = 'services_grid';
    const TYPE_CONTACT_FORM = 'contact_form';
    const TYPE_FAQ = 'faq';
    const TYPE_TEAM = 'team';
    const TYPE_TESTIMONIALS = 'testimonials';
    const TYPE_STATISTICS = 'statistics';
    const TYPE_BREADCRUMB = 'breadcrumb';

    public static function getSectionTypes()
    {
        return [
            self::TYPE_HERO_BANNER => 'Hero Banner',
            self::TYPE_RICH_CONTENT => 'Rich HTML Content',
            self::TYPE_DATA_TABLE => 'Data Table',
            self::TYPE_IMAGE_GALLERY => 'Image Gallery',
            self::TYPE_SERVICES_GRID => 'Services Grid',
            self::TYPE_CONTACT_FORM => 'Contact Form',
            self::TYPE_FAQ => 'FAQ Section',
            self::TYPE_TEAM => 'Team Section',
            self::TYPE_TESTIMONIALS => 'Testimonials',
            self::TYPE_STATISTICS => 'Statistics Counter',
            self::TYPE_BREADCRUMB => 'Breadcrumb Navigation',
        ];
    }
}
