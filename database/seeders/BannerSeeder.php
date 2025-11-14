<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            // Hero Banner 1
            [
                'name' => 'Main Hero Banner',
                'title' => 'Welcome to Our Website',
                'description' => 'Discover amazing services and solutions tailored to your needs',
                'image' => '/assets/img/hero/hero_bg_1_1.jpg',
                'banner_type' => 'hero',
                'height' => '600px',
                'text_position' => 'center',
                'text_color' => '#ffffff',
                'show_overlay' => true,
                'overlay_color' => 'rgba(0, 0, 0, 0.5)',
                'button_text' => 'Get Started',
                'button_url' => '#services',
                'button_action' => 'scroll',
                'button_target' => '_self',
                'button_style' => 'primary',
                'button_text_2' => 'Learn More',
                'button_url_2' => '/about',
                'button_action_2' => 'link',
                'button_target_2' => '_self',
                'button_style_2' => 'outline-light',
                'is_active' => true,
                'sort_order' => 1,
            ],

            // Hero Banner 2
            [
                'name' => 'Services Hero Banner',
                'title' => 'Professional Services',
                'description' => 'Excellence in every solution we deliver',
                'image' => '/assets/img/hero/hero_bg_1_1.jpg',
                'banner_type' => 'hero',
                'height' => '500px',
                'text_position' => 'left',
                'text_color' => '#ffffff',
                'show_overlay' => true,
                'overlay_color' => 'rgba(102, 126, 234, 0.7)',
                'button_text' => 'View Services',
                'button_url' => '/services',
                'button_action' => 'link',
                'button_target' => '_self',
                'button_style' => 'light',
                'is_active' => true,
                'sort_order' => 2,
            ],

            // Promotional Banner
            [
                'name' => 'Special Offer Banner',
                'title' => 'Limited Time Offer!',
                'description' => 'Get 30% off on all services this month. Don\'t miss out on this amazing opportunity!',
                'image' => '/assets/img/hero/hero_bg_1_1.jpg',
                'banner_type' => 'promotional',
                'height' => '400px',
                'text_position' => 'left',
                'text_color' => '#ffffff',
                'show_overlay' => false,
                'button_text' => 'Claim Offer',
                'button_url' => '/contact',
                'button_action' => 'link',
                'button_target' => '_self',
                'button_style' => 'warning',
                'is_active' => true,
                'sort_order' => 3,
            ],

            // Image Banner
            [
                'name' => 'About Us Banner',
                'title' => 'Who We Are',
                'description' => 'Building trust through quality and dedication',
                'image' => '/assets/img/hero/hero_bg_1_1.jpg',
                'banner_type' => 'image',
                'height' => '400px',
                'text_position' => 'center',
                'text_color' => '#ffffff',
                'show_overlay' => true,
                'overlay_color' => 'rgba(0, 0, 0, 0.4)',
                'is_active' => true,
                'sort_order' => 4,
            ],

            // Slider Banner
            [
                'name' => 'Homepage Slider',
                'title' => 'Multi-Slide Carousel',
                'description' => 'Showcase multiple messages',
                'banner_type' => 'slider',
                'height' => '600px',
                'text_color' => '#ffffff',
                'autoplay' => true,
                'interval' => 5,
                'transition' => 'slide',
                'slides' => [
                    [
                        'image' => '/assets/img/hero/hero_bg_1_1.jpg',
                        'title' => 'First Slide Title',
                        'description' => 'This is the description for the first slide',
                    ],
                    [
                        'image' => '/assets/img/hero/hero_bg_1_1.jpg',
                        'title' => 'Second Slide Title',
                        'description' => 'This is the description for the second slide',
                    ],
                    [
                        'image' => '/assets/img/hero/hero_bg_1_1.jpg',
                        'title' => 'Third Slide Title',
                        'description' => 'This is the description for the third slide',
                    ],
                ],
                'is_active' => true,
                'sort_order' => 5,
            ],

            // Call to Action Banner
            [
                'name' => 'CTA Banner - Contact',
                'title' => 'Ready to Get Started?',
                'description' => 'Contact us today and let\'s discuss how we can help you achieve your goals',
                'image' => '/assets/img/hero/hero_bg_1_1.jpg',
                'banner_type' => 'hero',
                'height' => '350px',
                'text_position' => 'center',
                'text_color' => '#ffffff',
                'show_overlay' => true,
                'overlay_color' => 'rgba(118, 75, 162, 0.8)',
                'button_text' => 'Contact Us Now',
                'button_url' => '/contact',
                'button_action' => 'link',
                'button_target' => '_self',
                'button_style' => 'light',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }

        $this->command->info('✅ Created ' . count($banners) . ' banners successfully!');
    }
}
