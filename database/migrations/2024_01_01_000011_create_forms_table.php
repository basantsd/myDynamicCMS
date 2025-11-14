<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Form name for admin reference');
            $table->string('title');
            $table->text('description')->nullable();

            // Form type and configuration
            $table->enum('form_type', ['submission', 'calculation', 'action'])->default('submission');
            $table->string('submission_endpoint')->nullable()->comment('API endpoint for form submission');
            $table->string('success_message')->default('Form submitted successfully!');
            $table->string('error_message')->default('An error occurred. Please try again.');
            $table->string('redirect_url')->nullable()->comment('Redirect URL after successful submission');

            // Form fields configuration (JSON)
            // Example structure:
            // [
            //   {
            //     "name": "email",
            //     "type": "email",
            //     "label": "Email Address",
            //     "placeholder": "Enter your email",
            //     "required": true,
            //     "validation": "email|required",
            //     "default_value": "",
            //     "help_text": "We'll never share your email"
            //   }
            // ]
            $table->json('fields')->comment('Array of form field configurations');

            // Calculation configuration (for calculation type forms)
            // Example structure:
            // {
            //   "formula": "field1 + field2 * field3",
            //   "result_field": "total",
            //   "result_label": "Total Amount",
            //   "calculation_type": "sum|average|custom",
            //   "fields_to_calculate": ["field1", "field2"],
            //   "custom_formula": "field1 * 0.1 + field2"
            // }
            $table->json('calculation_config')->nullable()->comment('Calculation configuration for calculation forms');

            // Action configuration (for action type forms)
            // Example structure:
            // {
            //   "action_type": "email|api|webhook",
            //   "email_to": "admin@example.com",
            //   "api_url": "https://api.example.com/endpoint",
            //   "webhook_url": "https://webhook.example.com",
            //   "headers": {"Authorization": "Bearer token"}
            // }
            $table->json('action_config')->nullable()->comment('Action configuration for action forms');

            // Form styling
            $table->enum('layout', ['centered', 'left', 'right', 'split', 'inline'])->default('centered');
            $table->string('submit_button_text')->default('Submit');
            $table->string('submit_button_style')->default('primary');
            $table->string('form_width')->default('100%')->comment('Form width: 100%, 600px, etc');
            $table->string('background_color')->nullable();

            // Email notification settings
            $table->boolean('send_email_notification')->default(false);
            $table->string('notification_email')->nullable();
            $table->string('notification_subject')->nullable();
            $table->text('notification_template')->nullable();

            // Auto-responder settings
            $table->boolean('send_auto_response')->default(false);
            $table->string('auto_response_subject')->nullable();
            $table->text('auto_response_template')->nullable();
            $table->string('auto_response_email_field')->nullable()->comment('Which form field contains the user email');

            // Additional settings
            $table->boolean('store_submissions')->default(true)->comment('Store form submissions in database');
            $table->boolean('enable_captcha')->default(false);
            $table->text('custom_css')->nullable();
            $table->text('custom_js')->nullable();

            // Status and ordering
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        // Create form_submissions table to store submitted data
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->json('data')->comment('Submitted form data');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
        Schema::dropIfExists('forms');
    }
};
