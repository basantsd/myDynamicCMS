<?php

namespace Database\Seeders;

use App\Models\CustomBlock;
use Illuminate\Database\Seeder;

class FormBuilderBlockSeeder extends Seeder
{
    public function run(): void
    {
        CustomBlock::create([
            'name' => 'Dynamic Form Builder',
            'slug' => 'dynamic-form-builder',
            'category' => 'form',
            'description' => 'Create custom forms with any fields, validation, and file uploads',
            'icon' => 'fas fa-wpforms',
            'is_active' => true,
            'schema' => [
                'fields' => [
                    [
                        'name' => 'form_title',
                        'label' => 'Form Title',
                        'type' => 'text',
                        'default' => 'Contact Us',
                        'required' => true
                    ],
                    [
                        'name' => 'form_subtitle',
                        'label' => 'Form Subtitle',
                        'type' => 'text',
                        'default' => 'Fill out the form below and we\'ll get back to you soon',
                        'required' => false
                    ],
                    [
                        'name' => 'form_name',
                        'label' => 'Form Identifier',
                        'type' => 'text',
                        'default' => 'custom_form',
                        'required' => true,
                        'help' => 'Unique identifier for this form (lowercase, no spaces)'
                    ],
                    [
                        'name' => 'submit_button_text',
                        'label' => 'Submit Button Text',
                        'type' => 'text',
                        'default' => 'Submit',
                        'required' => true
                    ],
                    [
                        'name' => 'success_message',
                        'label' => 'Success Message',
                        'type' => 'textarea',
                        'default' => 'Thank you! Your form has been submitted successfully.',
                        'required' => false
                    ],
                    [
                        'name' => 'form_fields',
                        'label' => 'Form Fields (JSON)',
                        'type' => 'code',
                        'default' => json_encode([
                            [
                                'name' => 'name',
                                'label' => 'Full Name',
                                'type' => 'text',
                                'placeholder' => 'Enter your full name',
                                'required' => true,
                                'validation' => 'required|min:3|max:100'
                            ],
                            [
                                'name' => 'email',
                                'label' => 'Email Address',
                                'type' => 'email',
                                'placeholder' => 'your@email.com',
                                'required' => true,
                                'validation' => 'required|email'
                            ],
                            [
                                'name' => 'message',
                                'label' => 'Message',
                                'type' => 'textarea',
                                'placeholder' => 'Your message here...',
                                'required' => true,
                                'rows' => 5,
                                'validation' => 'required|min:10'
                            ]
                        ], JSON_PRETTY_PRINT),
                        'required' => true,
                        'help' => 'Define form fields in JSON format'
                    ],
                    [
                        'name' => 'enable_file_upload',
                        'label' => 'Enable File Upload',
                        'type' => 'checkbox',
                        'default' => false
                    ],
                    [
                        'name' => 'max_file_size',
                        'label' => 'Max File Size (MB)',
                        'type' => 'number',
                        'default' => 5,
                        'required' => false
                    ],
                    [
                        'name' => 'allowed_file_types',
                        'label' => 'Allowed File Types',
                        'type' => 'text',
                        'default' => 'pdf,doc,docx,jpg,png',
                        'required' => false,
                        'help' => 'Comma-separated file extensions'
                    ],
                    [
                        'name' => 'layout',
                        'label' => 'Form Layout',
                        'type' => 'select',
                        'options' => [
                            'single' => 'Single Column',
                            'two-column' => 'Two Columns'
                        ],
                        'default' => 'single'
                    ]
                ]
            ],
            'default_values' => [
                'form_title' => 'Contact Us',
                'form_subtitle' => 'Fill out the form below and we\'ll get back to you soon',
                'form_name' => 'contact_form',
                'submit_button_text' => 'Submit',
                'success_message' => 'Thank you! Your form has been submitted successfully.',
                'layout' => 'single',
                'enable_file_upload' => false,
                'max_file_size' => 5,
                'allowed_file_types' => 'pdf,doc,docx,jpg,png'
            ],
            'template' => 'sections.dynamic_form_builder'
        ]);
    }
}
