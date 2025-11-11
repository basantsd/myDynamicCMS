<?php

namespace Database\Seeders;

use App\Models\CustomBlock;
use Illuminate\Database\Seeder;

class CustomBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blocks = [
            // Hero Section with Background Image
            [
                'name' => 'Hero with Background Image',
                'icon' => 'fa-image',
                'category' => 'hero',
                'description' => 'Full-width hero section with background image, heading, description, and call-to-action buttons',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'background_image',
                            'type' => 'image',
                            'label' => 'Background Image',
                            'required' => true,
                        ],
                        [
                            'name' => 'heading',
                            'type' => 'text',
                            'label' => 'Heading',
                            'required' => true,
                        ],
                        [
                            'name' => 'subheading',
                            'type' => 'text',
                            'label' => 'Subheading',
                            'required' => false,
                        ],
                        [
                            'name' => 'description',
                            'type' => 'textarea',
                            'label' => 'Description',
                            'required' => false,
                        ],
                        [
                            'name' => 'primary_button',
                            'type' => 'button',
                            'label' => 'Primary Button',
                            'fields' => ['text', 'url', 'style'],
                            'required' => false,
                        ],
                        [
                            'name' => 'secondary_button',
                            'type' => 'button',
                            'label' => 'Secondary Button',
                            'fields' => ['text', 'url', 'style'],
                            'required' => false,
                        ],
                    ],
                ],
                'default_values' => [
                    'heading' => 'Welcome to Our Website',
                    'subheading' => 'We Create Amazing Experiences',
                    'description' => 'Discover how we can help you achieve your goals',
                    'primary_button' => [
                        'text' => 'Get Started',
                        'url' => '#',
                        'style' => 'primary',
                    ],
                ],
            ],

            // Hero with Video Background
            [
                'name' => 'Hero with Video Background',
                'icon' => 'fa-video',
                'category' => 'hero',
                'description' => 'Hero section with video background and overlay content',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'video_url',
                            'type' => 'video',
                            'label' => 'Video URL',
                            'required' => true,
                        ],
                        [
                            'name' => 'video_poster',
                            'type' => 'image',
                            'label' => 'Video Poster (Thumbnail)',
                            'required' => false,
                        ],
                        [
                            'name' => 'overlay_opacity',
                            'type' => 'range',
                            'label' => 'Overlay Opacity',
                            'min' => 0,
                            'max' => 100,
                            'required' => false,
                        ],
                        [
                            'name' => 'heading',
                            'type' => 'text',
                            'label' => 'Heading',
                            'required' => true,
                        ],
                        [
                            'name' => 'description',
                            'type' => 'textarea',
                            'label' => 'Description',
                            'required' => false,
                        ],
                        [
                            'name' => 'button',
                            'type' => 'button',
                            'label' => 'Call to Action',
                            'fields' => ['text', 'url', 'style'],
                            'required' => false,
                        ],
                    ],
                ],
                'default_values' => [
                    'overlay_opacity' => 50,
                    'heading' => 'Watch Our Story',
                    'description' => 'Experience the difference',
                ],
            ],

            // Hero with Image Gallery
            [
                'name' => 'Hero with Image Slider',
                'icon' => 'fa-images',
                'category' => 'hero',
                'description' => 'Hero section with image carousel/slider',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'slides',
                            'type' => 'repeater',
                            'label' => 'Slides',
                            'fields' => [
                                [
                                    'name' => 'image',
                                    'type' => 'image',
                                    'label' => 'Image',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'heading',
                                    'type' => 'text',
                                    'label' => 'Heading',
                                    'required' => false,
                                ],
                                [
                                    'name' => 'description',
                                    'type' => 'textarea',
                                    'label' => 'Description',
                                    'required' => false,
                                ],
                                [
                                    'name' => 'button',
                                    'type' => 'button',
                                    'label' => 'Button',
                                    'fields' => ['text', 'url', 'style'],
                                    'required' => false,
                                ],
                            ],
                            'required' => true,
                        ],
                        [
                            'name' => 'autoplay',
                            'type' => 'toggle',
                            'label' => 'Autoplay',
                            'required' => false,
                        ],
                        [
                            'name' => 'interval',
                            'type' => 'number',
                            'label' => 'Slide Interval (seconds)',
                            'required' => false,
                        ],
                    ],
                ],
                'default_values' => [
                    'autoplay' => true,
                    'interval' => 5,
                    'slides' => [],
                ],
            ],

            // Hero with Split Content
            [
                'name' => 'Hero Split Layout',
                'icon' => 'fa-columns',
                'category' => 'hero',
                'description' => 'Hero section with split layout - image on one side, content on the other',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'image_position',
                            'type' => 'select',
                            'label' => 'Image Position',
                            'options' => ['left', 'right'],
                            'required' => true,
                        ],
                        [
                            'name' => 'image',
                            'type' => 'image',
                            'label' => 'Image',
                            'required' => true,
                        ],
                        [
                            'name' => 'heading',
                            'type' => 'text',
                            'label' => 'Heading',
                            'required' => true,
                        ],
                        [
                            'name' => 'subheading',
                            'type' => 'text',
                            'label' => 'Subheading',
                            'required' => false,
                        ],
                        [
                            'name' => 'description',
                            'type' => 'wysiwyg',
                            'label' => 'Description',
                            'required' => false,
                        ],
                        [
                            'name' => 'features',
                            'type' => 'repeater',
                            'label' => 'Feature List',
                            'fields' => [
                                [
                                    'name' => 'icon',
                                    'type' => 'icon',
                                    'label' => 'Icon',
                                    'required' => false,
                                ],
                                [
                                    'name' => 'text',
                                    'type' => 'text',
                                    'label' => 'Text',
                                    'required' => true,
                                ],
                            ],
                            'required' => false,
                        ],
                        [
                            'name' => 'buttons',
                            'type' => 'repeater',
                            'label' => 'Buttons',
                            'fields' => [
                                [
                                    'name' => 'text',
                                    'type' => 'text',
                                    'label' => 'Button Text',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'url',
                                    'type' => 'text',
                                    'label' => 'Button URL',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'style',
                                    'type' => 'select',
                                    'label' => 'Button Style',
                                    'options' => ['primary', 'secondary', 'outline'],
                                    'required' => false,
                                ],
                            ],
                            'required' => false,
                        ],
                    ],
                ],
                'default_values' => [
                    'image_position' => 'right',
                    'heading' => 'Transform Your Business',
                    'features' => [],
                    'buttons' => [],
                ],
            ],

            // Hero with Data Table
            [
                'name' => 'Hero with Statistics Table',
                'icon' => 'fa-table',
                'category' => 'hero',
                'description' => 'Hero section featuring a data table with statistics or pricing',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'heading',
                            'type' => 'text',
                            'label' => 'Heading',
                            'required' => true,
                        ],
                        [
                            'name' => 'description',
                            'type' => 'textarea',
                            'label' => 'Description',
                            'required' => false,
                        ],
                        [
                            'name' => 'table_data',
                            'type' => 'table',
                            'label' => 'Table Data',
                            'fields' => [
                                [
                                    'name' => 'headers',
                                    'type' => 'array',
                                    'label' => 'Table Headers',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'rows',
                                    'type' => 'repeater',
                                    'label' => 'Table Rows',
                                    'required' => true,
                                ],
                            ],
                            'required' => true,
                        ],
                        [
                            'name' => 'table_style',
                            'type' => 'select',
                            'label' => 'Table Style',
                            'options' => ['default', 'striped', 'bordered', 'hover'],
                            'required' => false,
                        ],
                    ],
                ],
                'default_values' => [
                    'heading' => 'Our Performance',
                    'table_style' => 'striped',
                    'table_data' => [
                        'headers' => ['Metric', 'Value', 'Growth'],
                        'rows' => [],
                    ],
                ],
            ],

            // Hero with CTA Form
            [
                'name' => 'Hero with Call-to-Action Form',
                'icon' => 'fa-envelope',
                'category' => 'hero',
                'description' => 'Hero section with integrated contact or signup form',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'background_image',
                            'type' => 'image',
                            'label' => 'Background Image',
                            'required' => false,
                        ],
                        [
                            'name' => 'heading',
                            'type' => 'text',
                            'label' => 'Heading',
                            'required' => true,
                        ],
                        [
                            'name' => 'description',
                            'type' => 'textarea',
                            'label' => 'Description',
                            'required' => false,
                        ],
                        [
                            'name' => 'form_title',
                            'type' => 'text',
                            'label' => 'Form Title',
                            'required' => false,
                        ],
                        [
                            'name' => 'form_fields',
                            'type' => 'repeater',
                            'label' => 'Form Fields',
                            'fields' => [
                                [
                                    'name' => 'type',
                                    'type' => 'select',
                                    'label' => 'Field Type',
                                    'options' => ['text', 'email', 'tel', 'textarea', 'select'],
                                    'required' => true,
                                ],
                                [
                                    'name' => 'label',
                                    'type' => 'text',
                                    'label' => 'Field Label',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'placeholder',
                                    'type' => 'text',
                                    'label' => 'Placeholder',
                                    'required' => false,
                                ],
                                [
                                    'name' => 'required',
                                    'type' => 'toggle',
                                    'label' => 'Required',
                                    'required' => false,
                                ],
                            ],
                            'required' => false,
                        ],
                        [
                            'name' => 'submit_button_text',
                            'type' => 'text',
                            'label' => 'Submit Button Text',
                            'required' => false,
                        ],
                    ],
                ],
                'default_values' => [
                    'heading' => 'Get Started Today',
                    'form_title' => 'Contact Us',
                    'submit_button_text' => 'Submit',
                    'form_fields' => [
                        ['type' => 'text', 'label' => 'Name', 'required' => true],
                        ['type' => 'email', 'label' => 'Email', 'required' => true],
                    ],
                ],
            ],

            // Hero Minimal
            [
                'name' => 'Minimal Hero',
                'icon' => 'fa-heading',
                'category' => 'hero',
                'description' => 'Clean, minimal hero section with centered text',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'background_color',
                            'type' => 'color',
                            'label' => 'Background Color',
                            'required' => false,
                        ],
                        [
                            'name' => 'heading',
                            'type' => 'text',
                            'label' => 'Heading',
                            'required' => true,
                        ],
                        [
                            'name' => 'subheading',
                            'type' => 'text',
                            'label' => 'Subheading',
                            'required' => false,
                        ],
                        [
                            'name' => 'button',
                            'type' => 'button',
                            'label' => 'Button',
                            'fields' => ['text', 'url', 'style'],
                            'required' => false,
                        ],
                    ],
                ],
                'default_values' => [
                    'background_color' => '#f8f9fa',
                    'heading' => 'Simple. Powerful. Effective.',
                ],
            ],

            // Hero with Icon Features
            [
                'name' => 'Hero with Icon Features',
                'icon' => 'fa-star',
                'category' => 'hero',
                'description' => 'Hero section with prominent icon-based features grid',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'background_image',
                            'type' => 'image',
                            'label' => 'Background Image',
                            'required' => false,
                        ],
                        [
                            'name' => 'heading',
                            'type' => 'text',
                            'label' => 'Heading',
                            'required' => true,
                        ],
                        [
                            'name' => 'description',
                            'type' => 'textarea',
                            'label' => 'Description',
                            'required' => false,
                        ],
                        [
                            'name' => 'features',
                            'type' => 'repeater',
                            'label' => 'Features',
                            'fields' => [
                                [
                                    'name' => 'icon',
                                    'type' => 'icon',
                                    'label' => 'Icon',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'title',
                                    'type' => 'text',
                                    'label' => 'Title',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'description',
                                    'type' => 'textarea',
                                    'label' => 'Description',
                                    'required' => false,
                                ],
                            ],
                            'required' => true,
                        ],
                        [
                            'name' => 'button',
                            'type' => 'button',
                            'label' => 'Call to Action',
                            'fields' => ['text', 'url', 'style'],
                            'required' => false,
                        ],
                    ],
                ],
                'default_values' => [
                    'heading' => 'Why Choose Us',
                    'features' => [],
                ],
            ],
        ];

        foreach ($blocks as $block) {
            CustomBlock::create($block);
        }
    }
}
