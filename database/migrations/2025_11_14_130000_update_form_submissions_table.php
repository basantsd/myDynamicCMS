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
        Schema::table('form_submissions', function (Blueprint $table) {
            // Add form_id column
            $table->foreignId('form_id')->nullable()->after('page_section_id')->constrained()->onDelete('cascade');

            // Make form_name nullable since we're switching to form_id
            $table->string('form_name')->nullable()->change();

            // Add user_id for tracking authenticated users
            $table->foreignId('user_id')->nullable()->after('form_id')->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->dropForeign(['form_id']);
            $table->dropColumn('form_id');

            $table->string('form_name')->nullable(false)->change();

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
