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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Banner name for admin reference');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable()->comment('Banner background image');
            $table->string('video_url')->nullable()->comment('Video URL for video banners');

            // Button configuration
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->enum('button_action', ['link', 'redirect', 'download', 'modal', 'scroll'])->default('link');
            $table->string('button_target')->default('_self')->comment('_self or _blank');
            $table->string('button_style')->default('primary')->comment('primary, secondary, success, etc');

            // Secondary button
            $table->string('button_text_2')->nullable();
            $table->string('button_url_2')->nullable();
            $table->enum('button_action_2', ['link', 'redirect', 'download', 'modal', 'scroll'])->nullable();
            $table->string('button_target_2')->default('_self');
            $table->string('button_style_2')->default('outline-light');

            // Banner styling
            $table->enum('banner_type', ['hero', 'promotional', 'image', 'video', 'slider'])->default('hero');
            $table->string('height')->default('500px')->comment('Banner height: 300px, 500px, 100vh, etc');
            $table->enum('text_position', ['left', 'center', 'right'])->default('center');
            $table->boolean('show_overlay')->default(true);
            $table->string('overlay_color')->default('rgba(0,0,0,0.5)');
            $table->string('text_color')->default('#ffffff');

            // Slider configuration (if banner_type is slider)
            $table->json('slides')->nullable()->comment('Array of slide objects for slider type');
            $table->boolean('autoplay')->default(true);
            $table->integer('interval')->default(5)->comment('Slide interval in seconds');
            $table->enum('transition', ['slide', 'fade', 'zoom'])->default('slide');

            // Additional styling
            $table->text('custom_css')->nullable();
            $table->text('custom_js')->nullable();

            // Status and ordering
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
