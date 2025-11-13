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
            // ========== SLIDER BLOCKS ==========
            [
                'name' => 'Image Slider with Autoplay',
                'icon' => 'fa-images',
                'color' => '#9b59b6',
                'category' => 'slider',
                'description' => 'Responsive image slider with autoplay, multiple slides, and customizable transitions',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'slides',
                            'type' => 'repeater',
                            'label' => 'Slides',
                            'required' => true,
                            'fields' => [
                                ['name' => 'image', 'type' => 'image', 'label' => 'Image', 'required' => true],
                                ['name' => 'heading', 'type' => 'text', 'label' => 'Heading'],
                                ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                                ['name' => 'button', 'type' => 'button', 'label' => 'CTA Button'],
                            ],
                        ],
                    ],
                ],
                'advanced_features' => [
                    'autoplay' => true,
                    'interval' => 5,
                    'transition' => 'slide',
                    'navigation_style' => 'both',
                ],
                'default_values' => [
                    'autoplay' => true,
                    'interval' => 5,
                    'slides' => [],
                ],
            ],

            [
                'name' => 'Testimonial Slider',
                'icon' => 'fa-quote-left',
                'color' => '#9b59b6',
                'category' => 'slider',
                'description' => 'Slider for customer testimonials with ratings and photos',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'testimonials',
                            'type' => 'repeater',
                            'label' => 'Testimonials',
                            'required' => true,
                            'fields' => [
                                ['name' => 'photo', 'type' => 'image', 'label' => 'Customer Photo'],
                                ['name' => 'name', 'type' => 'text', 'label' => 'Name', 'required' => true],
                                ['name' => 'position', 'type' => 'text', 'label' => 'Position/Company'],
                                ['name' => 'testimonial', 'type' => 'textarea', 'label' => 'Testimonial', 'required' => true],
                                ['name' => 'rating', 'type' => 'number', 'label' => 'Rating (1-5)'],
                            ],
                        ],
                    ],
                ],
                'advanced_features' => [
                    'autoplay' => true,
                    'interval' => 7,
                    'show_ratings' => true,
                ],
                'default_values' => [
                    'testimonials' => [],
                ],
            ],

            // ========== TABLE BLOCKS ==========
            [
                'name' => 'Data Table with CSV Import',
                'icon' => 'fa-table',
                'color' => '#e74c3c',
                'category' => 'table',
                'description' => 'Dynamic table with CSV import/export, sortable columns, and inline editing',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'table_data',
                            'type' => 'table',
                            'label' => 'Table Data',
                            'required' => true,
                        ],
                        [
                            'name' => 'table_style',
                            'type' => 'select',
                            'label' => 'Table Style',
                            'options' => ['default', 'striped', 'bordered', 'hover'],
                        ],
                    ],
                ],
                'action_settings' => [
                    'csv_import' => true,
                    'csv_export' => true,
                    'sortable' => true,
                    'searchable' => true,
                ],
                'default_values' => [
                    'table_style' => 'striped',
                    'table_data' => [
                        'headers' => ['Column 1', 'Column 2', 'Column 3'],
                        'rows' => [],
                    ],
                ],
            ],

            [
                'name' => 'Pricing Table',
                'icon' => 'fa-tags',
                'color' => '#e74c3c',
                'category' => 'table',
                'description' => 'Pricing comparison table with features and call-to-action buttons',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'plans',
                            'type' => 'repeater',
                            'label' => 'Pricing Plans',
                            'required' => true,
                            'fields' => [
                                ['name' => 'name', 'type' => 'text', 'label' => 'Plan Name', 'required' => true],
                                ['name' => 'price', 'type' => 'text', 'label' => 'Price', 'required' => true],
                                ['name' => 'period', 'type' => 'text', 'label' => 'Period (e.g., /month)'],
                                ['name' => 'features', 'type' => 'textarea', 'label' => 'Features (one per line)'],
                                ['name' => 'button', 'type' => 'button', 'label' => 'CTA Button'],
                                ['name' => 'featured', 'type' => 'toggle', 'label' => 'Featured Plan'],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'plans' => [],
                ],
            ],

            // ========== FORM BLOCKS ==========
            [
                'name' => 'Contact Form - Submission',
                'icon' => 'fa-envelope',
                'color' => '#3498db',
                'category' => 'form',
                'description' => 'Contact form that stores submissions in database',
                'schema' => [
                    'fields' => [
                        ['name' => 'form_title', 'type' => 'text', 'label' => 'Form Title'],
                        [
                            'name' => 'form_fields',
                            'type' => 'repeater',
                            'label' => 'Form Fields',
                            'required' => true,
                            'fields' => [
                                ['name' => 'type', 'type' => 'select', 'label' => 'Field Type', 'options' => ['text', 'email', 'tel', 'textarea', 'select'], 'required' => true],
                                ['name' => 'label', 'type' => 'text', 'label' => 'Label', 'required' => true],
                                ['name' => 'placeholder', 'type' => 'text', 'label' => 'Placeholder'],
                                ['name' => 'required', 'type' => 'toggle', 'label' => 'Required'],
                            ],
                        ],
                        ['name' => 'submit_button_text', 'type' => 'text', 'label' => 'Submit Button Text'],
                    ],
                ],
                'form_table_name' => 'contact_form_submissions',
                'default_values' => [
                    'form_title' => 'Contact Us',
                    'form_type' => 'submission',
                    'submit_button_text' => 'Send Message',
                    'form_fields' => [
                        ['type' => 'text', 'label' => 'Name', 'required' => true],
                        ['type' => 'email', 'label' => 'Email', 'required' => true],
                        ['type' => 'textarea', 'label' => 'Message', 'required' => true],
                    ],
                ],
            ],

            [
                'name' => 'Calculator Form - Calculation',
                'icon' => 'fa-calculator',
                'color' => '#3498db',
                'category' => 'form',
                'description' => 'Form that performs calculations based on user input',
                'schema' => [
                    'fields' => [
                        ['name' => 'form_title', 'type' => 'text', 'label' => 'Calculator Title'],
                        ['name' => 'calculation_type', 'type' => 'select', 'label' => 'Calculation Type', 'options' => ['sum', 'average', 'percentage', 'custom']],
                        [
                            'name' => 'form_fields',
                            'type' => 'repeater',
                            'label' => 'Input Fields',
                            'required' => true,
                            'fields' => [
                                ['name' => 'label', 'type' => 'text', 'label' => 'Label', 'required' => true],
                                ['name' => 'type', 'type' => 'select', 'label' => 'Type', 'options' => ['number', 'text'], 'required' => true],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'form_title' => 'Calculator',
                    'form_type' => 'calculation',
                    'calculation_type' => 'sum',
                ],
            ],

            [
                'name' => 'Newsletter Signup - Action',
                'icon' => 'fa-paper-plane',
                'color' => '#3498db',
                'category' => 'form',
                'description' => 'Newsletter subscription form with email validation',
                'schema' => [
                    'fields' => [
                        ['name' => 'heading', 'type' => 'text', 'label' => 'Heading'],
                        ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                        ['name' => 'submit_button_text', 'type' => 'text', 'label' => 'Button Text'],
                    ],
                ],
                'action_settings' => [
                    'action_type' => 'newsletter',
                    'success_message' => 'Thank you for subscribing!',
                ],
                'default_values' => [
                    'form_type' => 'action',
                    'heading' => 'Subscribe to Our Newsletter',
                    'submit_button_text' => 'Subscribe',
                ],
            ],

            // ========== BUTTON BLOCKS ==========
            [
                'name' => 'Call-to-Action Buttons',
                'icon' => 'fa-hand-pointer',
                'color' => '#f39c12',
                'category' => 'button',
                'description' => 'Customizable CTA buttons with multiple actions (link, download, redirect)',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'buttons',
                            'type' => 'repeater',
                            'label' => 'Buttons',
                            'required' => true,
                            'fields' => [
                                ['name' => 'text', 'type' => 'text', 'label' => 'Button Text', 'required' => true],
                                ['name' => 'url', 'type' => 'text', 'label' => 'URL', 'required' => true],
                                ['name' => 'style', 'type' => 'select', 'label' => 'Style', 'options' => ['primary', 'secondary', 'outline', 'success', 'danger']],
                                ['name' => 'action_type', 'type' => 'select', 'label' => 'Action', 'options' => ['link', 'download', 'redirect']],
                                ['name' => 'target', 'type' => 'select', 'label' => 'Target', 'options' => ['_self', '_blank']],
                                ['name' => 'icon', 'type' => 'icon', 'label' => 'Icon (optional)'],
                            ],
                        ],
                        ['name' => 'button_alignment', 'type' => 'select', 'label' => 'Alignment', 'options' => ['left', 'center', 'right']],
                        ['name' => 'button_size', 'type' => 'select', 'label' => 'Size', 'options' => ['sm', 'md', 'lg']],
                    ],
                ],
                'action_settings' => [
                    'supports_download' => true,
                    'supports_redirect' => true,
                    'supports_new_tab' => true,
                ],
                'default_values' => [
                    'button_alignment' => 'center',
                    'button_size' => 'md',
                    'buttons' => [],
                ],
            ],

            [
                'name' => 'Download Button',
                'icon' => 'fa-download',
                'color' => '#f39c12',
                'category' => 'button',
                'description' => 'Button for file downloads with icon and styling',
                'schema' => [
                    'fields' => [
                        ['name' => 'button_text', 'type' => 'text', 'label' => 'Button Text', 'required' => true],
                        ['name' => 'file_url', 'type' => 'text', 'label' => 'File URL', 'required' => true],
                        ['name' => 'file_size', 'type' => 'text', 'label' => 'File Size (e.g., 2.5 MB)'],
                        ['name' => 'style', 'type' => 'select', 'label' => 'Style', 'options' => ['primary', 'secondary', 'success']],
                    ],
                ],
                'action_settings' => [
                    'action_type' => 'download',
                ],
                'default_values' => [
                    'button_text' => 'Download File',
                    'style' => 'primary',
                ],
            ],

            // ========== LIST BLOCKS ==========
            [
                'name' => 'Icon List',
                'icon' => 'fa-list-ul',
                'color' => '#1abc9c',
                'category' => 'list',
                'description' => 'List with customizable icons for each item',
                'schema' => [
                    'fields' => [
                        ['name' => 'list_title', 'type' => 'text', 'label' => 'List Title'],
                        [
                            'name' => 'items',
                            'type' => 'repeater',
                            'label' => 'List Items',
                            'required' => true,
                            'fields' => [
                                ['name' => 'icon', 'type' => 'icon', 'label' => 'Icon'],
                                ['name' => 'text', 'type' => 'text', 'label' => 'Text', 'required' => true],
                                ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                            ],
                        ],
                        ['name' => 'list_style', 'type' => 'select', 'label' => 'Style', 'options' => ['default', 'compact', 'cards']],
                    ],
                ],
                'default_values' => [
                    'list_style' => 'default',
                    'items' => [],
                ],
            ],

            [
                'name' => 'Features List',
                'icon' => 'fa-check-circle',
                'color' => '#1abc9c',
                'category' => 'list',
                'description' => 'Feature list with icons, titles, and descriptions',
                'schema' => [
                    'fields' => [
                        ['name' => 'heading', 'type' => 'text', 'label' => 'Heading'],
                        [
                            'name' => 'features',
                            'type' => 'repeater',
                            'label' => 'Features',
                            'required' => true,
                            'fields' => [
                                ['name' => 'icon', 'type' => 'icon', 'label' => 'Icon', 'required' => true],
                                ['name' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
                                ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                            ],
                        ],
                        ['name' => 'columns', 'type' => 'select', 'label' => 'Columns', 'options' => ['1', '2', '3', '4']],
                    ],
                ],
                'default_values' => [
                    'columns' => '3',
                    'features' => [],
                ],
            ],

            // ========== HERO BLOCKS (Existing - Updated with color) ==========
            [
                'name' => 'Hero with Background Image',
                'icon' => 'fa-image',
                'color' => '#2ecc71',
                'category' => 'hero',
                'description' => 'Full-width hero section with background image, heading, description, and call-to-action buttons',
                'schema' => [
                    'fields' => [
                        ['name' => 'background_image', 'type' => 'image', 'label' => 'Background Image', 'required' => true],
                        ['name' => 'heading', 'type' => 'text', 'label' => 'Heading', 'required' => true],
                        ['name' => 'subheading', 'type' => 'text', 'label' => 'Subheading'],
                        ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                        ['name' => 'primary_button', 'type' => 'button', 'label' => 'Primary Button'],
                        ['name' => 'secondary_button', 'type' => 'button', 'label' => 'Secondary Button'],
                    ],
                ],
                'default_values' => [
                    'heading' => 'Welcome to Our Website',
                    'subheading' => 'We Create Amazing Experiences',
                ],
            ],

            [
                'name' => 'Hero with Video Background',
                'icon' => 'fa-video',
                'color' => '#2ecc71',
                'category' => 'hero',
                'description' => 'Hero section with video background and overlay content',
                'schema' => [
                    'fields' => [
                        ['name' => 'video_url', 'type' => 'video', 'label' => 'Video URL', 'required' => true],
                        ['name' => 'video_poster', 'type' => 'image', 'label' => 'Video Poster'],
                        ['name' => 'heading', 'type' => 'text', 'label' => 'Heading', 'required' => true],
                        ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                        ['name' => 'button', 'type' => 'button', 'label' => 'Call to Action'],
                    ],
                ],
                'default_values' => [
                    'heading' => 'Watch Our Story',
                ],
            ],
        ];

        foreach ($blocks as $block) {
            CustomBlock::create($block);
        }
    }
}
