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
        Schema::table('custom_blocks', function (Blueprint $table) {
            // Add HTML template for block structure
            $table->longText('html_template')->nullable()->after('schema');

            // Add CSS styles for block appearance
            $table->text('css_styles')->nullable()->after('html_template');

            // Add JavaScript for block functionality
            $table->text('js_scripts')->nullable()->after('css_styles');

            // GrapesJS traits configuration (sidebar controls)
            $table->json('traits_config')->nullable()->after('js_scripts');

            // External dependencies (Bootstrap, FontAwesome, etc.)
            $table->json('dependencies')->nullable()->after('traits_config');

            // Block version for tracking updates
            $table->string('block_version', 20)->default('1.0.0')->after('dependencies');

            // Block author
            $table->string('author')->nullable()->after('block_version');

            // Tags for categorization and search
            $table->json('tags')->nullable()->after('author');

            // Thumbnail preview image
            $table->string('thumbnail')->nullable()->after('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_blocks', function (Blueprint $table) {
            $table->dropColumn([
                'html_template',
                'css_styles',
                'js_scripts',
                'traits_config',
                'dependencies',
                'block_version',
                'author',
                'tags',
                'thumbnail'
            ]);
        });
    }
};
