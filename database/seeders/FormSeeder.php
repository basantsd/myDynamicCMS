<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = [
            // Submission Form 1 - Contact Form
            [
                'name' => 'contact_form',
                'title' => 'Contact Us',
                'description' => 'Get in touch with us. We\'d love to hear from you!',
                'form_type' => 'submission',
                'type' => 'dynamic',
                'submission_endpoint' => '/api/forms/submit',
                'success_message' => 'Thank you for contacting us! We\'ll get back to you soon.',
                'error_message' => 'Sorry, something went wrong. Please try again.',
                'fields' => [
                    [
                        'name' => 'full_name',
                        'type' => 'text',
                        'label' => 'Full Name',
                        'placeholder' => 'Enter your full name',
                        'required' => true,
                    ],
                    [
                        'name' => 'email',
                        'type' => 'email',
                        'label' => 'Email Address',
                        'placeholder' => 'your@email.com',
                        'required' => true,
                    ],
                    [
                        'name' => 'phone',
                        'type' => 'tel',
                        'label' => 'Phone Number',
                        'placeholder' => '+1 (123) 456-7890',
                        'required' => false,
                    ],
                    [
                        'name' => 'subject',
                        'type' => 'select',
                        'label' => 'Subject',
                        'required' => true,
                        'options' => ['General Inquiry', 'Support', 'Sales', 'Partnership', 'Other'],
                    ],
                    [
                        'name' => 'message',
                        'type' => 'textarea',
                        'label' => 'Message',
                        'placeholder' => 'Tell us how we can help you...',
                        'required' => true,
                    ],
                ],
                'layout' => 'centered',
                'submit_button_text' => 'Send Message',
                'submit_button_style' => 'primary',
                'background_color' => '#f9fafb',
                'send_email_notification' => true,
                'notification_email' => 'admin@example.com',
                'store_submissions' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],

            // Submission Form 2 - Newsletter Signup
            [
                'name' => 'newsletter_signup',
                'title' => 'Subscribe to Our Newsletter',
                'description' => 'Stay updated with our latest news and offers',
                'form_type' => 'submission',
                'type' => 'dynamic',
                'submission_endpoint' => '/api/forms/submit',
                'success_message' => 'Successfully subscribed! Check your email for confirmation.',
                'error_message' => 'Subscription failed. Please try again.',
                'fields' => [
                    [
                        'name' => 'email',
                        'type' => 'email',
                        'label' => 'Email Address',
                        'placeholder' => 'Enter your email',
                        'required' => true,
                    ],
                    [
                        'name' => 'consent',
                        'type' => 'checkbox',
                        'label' => 'I agree to receive marketing emails',
                        'placeholder' => 'I agree to receive marketing emails',
                        'required' => true,
                    ],
                ],
                'layout' => 'centered',
                'submit_button_text' => 'Subscribe Now',
                'submit_button_style' => 'success',
                'background_color' => '#ffffff',
                'store_submissions' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],

            // Submission Form 3 - Job Application
            [
                'name' => 'job_application',
                'title' => 'Join Our Team',
                'description' => 'Apply for open positions at our company',
                'form_type' => 'submission',
                'type' => 'dynamic',
                'submission_endpoint' => '/api/forms/submit',
                'success_message' => 'Application submitted! We\'ll review and get back to you.',
                'error_message' => 'Application failed. Please check all fields.',
                'fields' => [
                    [
                        'name' => 'applicant_name',
                        'type' => 'text',
                        'label' => 'Full Name',
                        'placeholder' => 'Your full name',
                        'required' => true,
                    ],
                    [
                        'name' => 'email',
                        'type' => 'email',
                        'label' => 'Email',
                        'placeholder' => 'your@email.com',
                        'required' => true,
                    ],
                    [
                        'name' => 'phone',
                        'type' => 'tel',
                        'label' => 'Phone',
                        'placeholder' => 'Your phone number',
                        'required' => true,
                    ],
                    [
                        'name' => 'position',
                        'type' => 'select',
                        'label' => 'Position Applied For',
                        'required' => true,
                        'options' => ['Software Developer', 'Designer', 'Marketing Manager', 'Sales Representative', 'Customer Support'],
                    ],
                    [
                        'name' => 'experience',
                        'type' => 'number',
                        'label' => 'Years of Experience',
                        'placeholder' => '0',
                        'required' => true,
                        'min' => '0',
                        'max' => '50',
                    ],
                    [
                        'name' => 'cover_letter',
                        'type' => 'textarea',
                        'label' => 'Cover Letter',
                        'placeholder' => 'Tell us why you\'re a great fit...',
                        'required' => true,
                    ],
                    [
                        'name' => 'resume',
                        'type' => 'file',
                        'label' => 'Resume/CV',
                        'accept' => '.pdf,.doc,.docx',
                        'required' => true,
                    ],
                ],
                'layout' => 'left',
                'submit_button_text' => 'Submit Application',
                'submit_button_style' => 'primary',
                'background_color' => '#f3f4f6',
                'send_email_notification' => true,
                'notification_email' => 'hr@example.com',
                'store_submissions' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],

            // Calculation Form 1 - Loan Calculator
            [
                'name' => 'loan_calculator',
                'title' => 'Loan Payment Calculator',
                'description' => 'Calculate your monthly loan payments',
                'form_type' => 'calculation',
                'type' => 'static',
                'fields' => [
                    [
                        'name' => 'loan_amount',
                        'type' => 'number',
                        'label' => 'Loan Amount ($)',
                        'placeholder' => '10000',
                        'required' => true,
                        'min' => '1000',
                        'max' => '1000000',
                        'step' => '1000',
                        'default_value' => '10000',
                    ],
                    [
                        'name' => 'interest_rate',
                        'type' => 'number',
                        'label' => 'Annual Interest Rate (%)',
                        'placeholder' => '5',
                        'required' => true,
                        'min' => '0',
                        'max' => '30',
                        'step' => '0.1',
                        'default_value' => '5',
                    ],
                    [
                        'name' => 'loan_term',
                        'type' => 'number',
                        'label' => 'Loan Term (years)',
                        'placeholder' => '5',
                        'required' => true,
                        'min' => '1',
                        'max' => '30',
                        'step' => '1',
                        'default_value' => '5',
                    ],
                    [
                        'name' => 'monthly_payment',
                        'type' => 'number',
                        'label' => 'Monthly Payment ($)',
                        'placeholder' => 'Calculated automatically',
                        'required' => false,
                        'readonly' => true,
                    ],
                ],
                'calculation_config' => [
                    'calculation_type' => 'custom',
                    'result_field' => 'monthly_payment',
                    'custom_formula' => '(parseFloat(document.querySelector("[name=loan_amount]").value) * (parseFloat(document.querySelector("[name=interest_rate]").value) / 100 / 12)) / (1 - Math.pow(1 + (parseFloat(document.querySelector("[name=interest_rate]").value) / 100 / 12), -(parseFloat(document.querySelector("[name=loan_term]").value) * 12)))',
                ],
                'layout' => 'centered',
                'submit_button_text' => 'Calculate',
                'submit_button_style' => 'info',
                'background_color' => '#eff6ff',
                'store_submissions' => false,
                'is_active' => true,
                'sort_order' => 4,
            ],

            // Calculation Form 2 - BMI Calculator
            [
                'name' => 'bmi_calculator',
                'title' => 'BMI Calculator',
                'description' => 'Calculate your Body Mass Index',
                'form_type' => 'calculation',
                'type' => 'static',
                'fields' => [
                    [
                        'name' => 'weight',
                        'type' => 'number',
                        'label' => 'Weight (kg)',
                        'placeholder' => '70',
                        'required' => true,
                        'min' => '20',
                        'max' => '300',
                        'step' => '0.1',
                        'default_value' => '70',
                    ],
                    [
                        'name' => 'height',
                        'type' => 'number',
                        'label' => 'Height (cm)',
                        'placeholder' => '170',
                        'required' => true,
                        'min' => '100',
                        'max' => '250',
                        'step' => '1',
                        'default_value' => '170',
                    ],
                    [
                        'name' => 'bmi',
                        'type' => 'number',
                        'label' => 'Your BMI',
                        'placeholder' => 'Calculated automatically',
                        'required' => false,
                        'readonly' => true,
                    ],
                ],
                'calculation_config' => [
                    'calculation_type' => 'custom',
                    'result_field' => 'bmi',
                    'custom_formula' => 'parseFloat(document.querySelector("[name=weight]").value) / Math.pow(parseFloat(document.querySelector("[name=height]").value) / 100, 2)',
                ],
                'layout' => 'centered',
                'submit_button_text' => 'Calculate BMI',
                'submit_button_style' => 'success',
                'background_color' => '#f0fdf4',
                'store_submissions' => false,
                'is_active' => true,
                'sort_order' => 5,
            ],

            // Calculation Form 3 - Simple Price Calculator
            [
                'name' => 'price_calculator',
                'title' => 'Price Calculator',
                'description' => 'Calculate total price with tax and discount',
                'form_type' => 'calculation',
                'type' => 'static',
                'fields' => [
                    [
                        'name' => 'base_price',
                        'type' => 'number',
                        'label' => 'Base Price ($)',
                        'placeholder' => '100',
                        'required' => true,
                        'min' => '0',
                        'step' => '0.01',
                        'default_value' => '100',
                    ],
                    [
                        'name' => 'quantity',
                        'type' => 'number',
                        'label' => 'Quantity',
                        'placeholder' => '1',
                        'required' => true,
                        'min' => '1',
                        'step' => '1',
                        'default_value' => '1',
                    ],
                    [
                        'name' => 'discount',
                        'type' => 'number',
                        'label' => 'Discount (%)',
                        'placeholder' => '0',
                        'required' => false,
                        'min' => '0',
                        'max' => '100',
                        'step' => '1',
                        'default_value' => '0',
                    ],
                    [
                        'name' => 'tax',
                        'type' => 'number',
                        'label' => 'Tax (%)',
                        'placeholder' => '10',
                        'required' => false,
                        'min' => '0',
                        'max' => '100',
                        'step' => '0.1',
                        'default_value' => '10',
                    ],
                    [
                        'name' => 'total',
                        'type' => 'number',
                        'label' => 'Total Price ($)',
                        'placeholder' => 'Calculated automatically',
                        'required' => false,
                        'readonly' => true,
                    ],
                ],
                'calculation_config' => [
                    'calculation_type' => 'custom',
                    'result_field' => 'total',
                    'custom_formula' => '(parseFloat(document.querySelector("[name=base_price]").value) * parseFloat(document.querySelector("[name=quantity]").value) * (1 - parseFloat(document.querySelector("[name=discount]").value) / 100) * (1 + parseFloat(document.querySelector("[name=tax]").value) / 100))',
                ],
                'layout' => 'centered',
                'submit_button_text' => 'Calculate Total',
                'submit_button_style' => 'warning',
                'background_color' => '#fffbeb',
                'store_submissions' => false,
                'is_active' => true,
                'sort_order' => 6,
            ],

            // Submission Form 4 - Feedback Form
            [
                'name' => 'feedback_form',
                'title' => 'Share Your Feedback',
                'description' => 'We value your opinion and would love to hear from you',
                'form_type' => 'submission',
                'type' => 'dynamic',
                'submission_endpoint' => '/api/forms/submit',
                'success_message' => 'Thank you for your feedback!',
                'error_message' => 'Failed to submit feedback. Please try again.',
                'fields' => [
                    [
                        'name' => 'name',
                        'type' => 'text',
                        'label' => 'Your Name',
                        'placeholder' => 'Enter your name',
                        'required' => false,
                    ],
                    [
                        'name' => 'email',
                        'type' => 'email',
                        'label' => 'Email (optional)',
                        'placeholder' => 'your@email.com',
                        'required' => false,
                    ],
                    [
                        'name' => 'rating',
                        'type' => 'select',
                        'label' => 'Overall Rating',
                        'required' => true,
                        'options' => ['Excellent', 'Good', 'Average', 'Poor', 'Very Poor'],
                    ],
                    [
                        'name' => 'feedback',
                        'type' => 'textarea',
                        'label' => 'Your Feedback',
                        'placeholder' => 'Share your thoughts...',
                        'required' => true,
                    ],
                    [
                        'name' => 'recommend',
                        'type' => 'radio',
                        'label' => 'Would you recommend us?',
                        'required' => true,
                        'options' => ['Yes', 'No', 'Maybe'],
                    ],
                ],
                'layout' => 'centered',
                'submit_button_text' => 'Submit Feedback',
                'submit_button_style' => 'primary',
                'background_color' => '#fefce8',
                'store_submissions' => true,
                'is_active' => true,
                'sort_order' => 7,
            ],
        ];

        foreach ($forms as $form) {
            Form::create($form);
        }

        $this->command->info('✅ Created ' . count($forms) . ' forms successfully!');
        $this->command->info('   - 4 Submission Forms (Contact, Newsletter, Job Application, Feedback)');
        $this->command->info('   - 3 Calculation Forms (Loan, BMI, Price Calculator)');
    }
}
