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
        // Drop tables in reverse order of dependencies
        Schema::dropIfExists('custom_block_usage');
        Schema::dropIfExists('custom_block_variants');

        // Remove custom_block_id column from page_sections if it exists
        if (Schema::hasColumn('page_sections', 'custom_block_id')) {
            Schema::table('page_sections', function (Blueprint $table) {
                $table->dropForeign(['custom_block_id']);
                $table->dropColumn('custom_block_id');
            });
        }

        Schema::dropIfExists('custom_blocks');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate custom_blocks table
        Schema::create('custom_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->default('fa-cube');
            $table->string('category')->default('hero');
            $table->text('description')->nullable();
            $table->string('preview_image')->nullable();
            $table->json('schema');
            $table->json('default_values')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('usage_count')->default(0);
            $table->timestamps();

            $table->index(['name', 'category']);
            $table->index('is_active');
        });

        // Recreate custom_block_variants table
        Schema::create('custom_block_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained('custom_blocks')->onDelete('cascade');
            $table->string('variant_name');
            $table->json('variant_config');
            $table->longText('html_template')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->index('block_id');
            $table->index('is_default');
        });

        // Recreate custom_block_usage table
        Schema::create('custom_block_usage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained('custom_blocks')->onDelete('cascade');
            $table->foreignId('page_id')->nullable()->constrained('pages')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('used_at')->useCurrent();

            $table->index('block_id');
            $table->index('page_id');
            $table->index('user_id');
            $table->index('used_at');
        });

        // Add custom_block_id back to page_sections
        Schema::table('page_sections', function (Blueprint $table) {
            $table->foreignId('custom_block_id')->nullable()->constrained()->onDelete('set null');
        });
    }
};
