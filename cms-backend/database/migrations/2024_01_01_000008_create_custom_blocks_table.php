<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Block name (e.g., "Hero with Background Image")
            $table->string('icon')->default('fa-cube'); // FontAwesome icon class
            $table->string('category')->default('hero'); // hero, content, media, etc.
            $table->text('description')->nullable(); // Block description
            $table->string('preview_image')->nullable(); // Preview thumbnail URL
            $table->json('schema'); // JSON schema defining the block structure
            $table->json('default_values')->nullable(); // Default values for the block
            $table->boolean('is_active')->default(true);
            $table->integer('usage_count')->default(0); // Track how many times this block is used
            $table->timestamps();
        });

        // Add index for search
        Schema::table('custom_blocks', function (Blueprint $table) {
            $table->index(['name', 'category']);
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_blocks');
    }
};
