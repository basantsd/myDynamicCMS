<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('custom_blocks', function (Blueprint $table) {
            $table->string('color')->default('#3498db')->after('icon'); // Action color for visual identification
            $table->json('advanced_features')->nullable()->after('schema'); // Slider settings, table settings, etc.
            $table->json('action_settings')->nullable()->after('advanced_features'); // View, download, redirect settings
            $table->string('form_table_name')->nullable()->after('action_settings'); // Dynamic table name for form storage
        });
    }

    public function down(): void
    {
        Schema::table('custom_blocks', function (Blueprint $table) {
            $table->dropColumn(['color', 'advanced_features', 'action_settings', 'form_table_name']);
        });
    }
};
