<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'title',
        'description',
        'image',
        'video_url',
        'button_text',
        'button_url',
        'button_action',
        'button_target',
        'button_style',
        'button_text_2',
        'button_url_2',
        'button_action_2',
        'button_target_2',
        'button_style_2',
        'banner_type',
        'height',
        'text_position',
        'show_overlay',
        'overlay_color',
        'text_color',
        'slides',
        'autoplay',
        'interval',
        'transition',
        'custom_css',
        'custom_js',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'slides' => 'array',
        'show_overlay' => 'boolean',
        'autoplay' => 'boolean',
        'is_active' => 'boolean',
        'interval' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Get active banners
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get banners ordered by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Generate HTML for the banner
     */
    public function generateHtml(): string
    {
        $html = '';

        switch ($this->banner_type) {
            case 'hero':
                $html = $this->generateHeroHtml();
                break;
            case 'promotional':
                $html = $this->generatePromotionalHtml();
                break;
            case 'image':
                $html = $this->generateImageHtml();
                break;
            case 'video':
                $html = $this->generateVideoHtml();
                break;
            case 'slider':
                $html = $this->generateSliderHtml();
                break;
        }

        return $html;
    }

    private function generateHeroHtml(): string
    {
        $overlay = $this->show_overlay ? "<div style='position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: {$this->overlay_color}; z-index: 1;'></div>" : '';
        $textAlignment = $this->text_position === 'center' ? 'text-center' : ($this->text_position === 'right' ? 'text-end' : 'text-start');

        $buttons = '';
        if ($this->button_text) {
            $target = $this->button_target ?? '_self';
            $buttons .= "<a href='{$this->button_url}' class='btn btn-{$this->button_style} btn-lg me-2' target='{$target}' style='padding: 15px 40px;'>{$this->button_text}</a>";
        }
        if ($this->button_text_2) {
            $target = $this->button_target_2 ?? '_self';
            $buttons .= "<a href='{$this->button_url_2}' class='btn btn-{$this->button_style_2} btn-lg' target='{$target}' style='padding: 15px 40px;'>{$this->button_text_2}</a>";
        }

        return <<<HTML
        <section class="banner-section hero-banner" style="background-image: url('{$this->image}'); background-size: cover; background-position: center; height: {$this->height}; position: relative; display: flex; align-items: center; color: {$this->text_color};">
            {$overlay}
            <div class="container" style="position: relative; z-index: 2;">
                <div class="row">
                    <div class="col-lg-8 mx-auto {$textAlignment}">
                        <h1 style="font-size: 56px; font-weight: bold; margin-bottom: 20px;">{$this->title}</h1>
                        <p style="font-size: 20px; margin-bottom: 30px;">{$this->description}</p>
                        <div class="banner-buttons">
                            {$buttons}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        HTML;
    }

    private function generatePromotionalHtml(): string
    {
        $overlay = $this->show_overlay ? "<div style='position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: {$this->overlay_color}; z-index: 1;'></div>" : '';

        $buttons = '';
        if ($this->button_text) {
            $target = $this->button_target ?? '_self';
            $buttons .= "<a href='{$this->button_url}' class='btn btn-{$this->button_style} btn-lg' target='{$target}' style='padding: 12px 35px;'>{$this->button_text}</a>";
        }

        return <<<HTML
        <section class="banner-section promotional-banner" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: {$this->height}; position: relative; display: flex; align-items: center; color: {$this->text_color};">
            {$overlay}
            <div class="container" style="position: relative; z-index: 2;">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="promotional-badge" style="display: inline-block; background: #fbbf24; color: #000; padding: 5px 15px; border-radius: 20px; font-weight: bold; margin-bottom: 15px;">SPECIAL OFFER</div>
                        <h2 style="font-size: 42px; font-weight: bold; margin-bottom: 20px;">{$this->title}</h2>
                        <p style="font-size: 18px; margin-bottom: 30px;">{$this->description}</p>
                        {$buttons}
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="{$this->image}" alt="{$this->title}" style="max-width: 100%; border-radius: 10px;">
                    </div>
                </div>
            </div>
        </section>
        HTML;
    }

    private function generateImageHtml(): string
    {
        $overlay = $this->show_overlay ? "<div style='position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: {$this->overlay_color}; z-index: 1;'></div>" : '';
        $textAlignment = $this->text_position === 'center' ? 'text-center' : ($this->text_position === 'right' ? 'text-end' : 'text-start');

        return <<<HTML
        <section class="banner-section image-banner" style="background-image: url('{$this->image}'); background-size: cover; background-position: center; height: {$this->height}; position: relative; display: flex; align-items: center; color: {$this->text_color};">
            {$overlay}
            <div class="container" style="position: relative; z-index: 2;">
                <div class="row">
                    <div class="col-12 {$textAlignment}">
                        <h2 style="font-size: 48px; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">{$this->title}</h2>
                        <p style="font-size: 20px; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">{$this->description}</p>
                    </div>
                </div>
            </div>
        </section>
        HTML;
    }

    private function generateVideoHtml(): string
    {
        $overlay = $this->show_overlay ? "<div style='position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: {$this->overlay_color}; z-index: 1;'></div>" : '';
        $textAlignment = $this->text_position === 'center' ? 'text-center' : ($this->text_position === 'right' ? 'text-end' : 'text-start');

        $buttons = '';
        if ($this->button_text) {
            $target = $this->button_target ?? '_self';
            $buttons .= "<a href='{$this->button_url}' class='btn btn-{$this->button_style} btn-lg mt-3' target='{$target}' style='padding: 12px 35px;'>{$this->button_text}</a>";
        }

        return <<<HTML
        <section class="banner-section video-banner" style="background: #000; height: {$this->height}; position: relative; overflow: hidden;">
            <video autoplay muted loop style="position: absolute; width: 100%; height: 100%; object-fit: cover; opacity: 0.7;">
                <source src="{$this->video_url}" type="video/mp4">
            </video>
            {$overlay}
            <div class="container" style="position: relative; z-index: 2; height: 100%; display: flex; align-items: center;">
                <div class="row w-100">
                    <div class="col-12 {$textAlignment}" style="color: {$this->text_color};">
                        <h2 style="font-size: 48px; font-weight: bold;">{$this->title}</h2>
                        <p style="font-size: 20px; margin-top: 20px;">{$this->description}</p>
                        {$buttons}
                    </div>
                </div>
            </div>
        </section>
        HTML;
    }

    private function generateSliderHtml(): string
    {
        if (empty($this->slides)) {
            return '';
        }

        $sliderId = 'slider-' . $this->id;
        $interval = $this->autoplay ? ($this->interval * 1000) : 'false';

        $slidesHtml = '';
        foreach ($this->slides as $index => $slide) {
            $active = $index === 0 ? 'active' : '';
            $slidesHtml .= <<<HTML
            <div class="carousel-item {$active}">
                <img src="{$slide['image']}" class="d-block w-100" alt="{$slide['title']}" style="height: {$this->height}; object-fit: cover;">
                <div class="carousel-caption" style="color: {$this->text_color};">
                    <h3 style="font-size: 42px; font-weight: bold;">{$slide['title']}</h3>
                    <p style="font-size: 18px;">{$slide['description']}</p>
                </div>
            </div>
            HTML;
        }

        return <<<HTML
        <div id="{$sliderId}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="{$interval}">
            <div class="carousel-inner">
                {$slidesHtml}
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#{$sliderId}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#{$sliderId}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        HTML;
    }
}
