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
        Schema::table('forms', function (Blueprint $table) {
            // Add type field: 'static' for calculators/result-based, 'dynamic' for submissions
            $table->enum('type', ['static', 'dynamic'])->default('dynamic')->after('form_type');
        });

        // Update existing forms based on their form_type
        DB::table('forms')->where('form_type', 'calculation')->update(['type' => 'static']);
        DB::table('forms')->where('form_type', 'action')->update(['type' => 'static']);
        DB::table('forms')->where('form_type', 'submission')->update(['type' => 'dynamic']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
