<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('page_section_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('form_name');
            $table->string('form_type')->default('submission'); // submission, calculation, action
            $table->json('form_data'); // The submitted form data
            $table->json('calculated_result')->nullable(); // For calculation-based forms
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('submitted_at');
            $table->timestamps();
        });

        // Add indexes for better query performance
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->index(['page_id', 'form_name']);
            $table->index('form_type');
            $table->index('submitted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};
