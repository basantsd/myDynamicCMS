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
        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('use_builder')->default(false)->after('template');
            $table->longText('builder_html')->nullable()->after('use_builder');
            $table->longText('builder_css')->nullable()->after('builder_html');
            $table->json('builder_data')->nullable()->after('builder_css');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['use_builder', 'builder_html', 'builder_css', 'builder_data']);
        });
    }
};
