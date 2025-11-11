<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'meta_description',
        'meta_keywords',
        'template',
        'use_builder',
        'builder_html',
        'builder_css',
        'builder_data',
        'is_published',
        'show_in_menu',
        'menu_order',
        'parent_id',
        'created_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'show_in_menu' => 'boolean',
        'use_builder' => 'boolean',
        'builder_data' => 'array',
    ];

    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id')->orderBy('menu_order');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
