<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->foreignId('custom_block_id')->nullable()->after('section_type')->constrained('custom_blocks')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropForeign(['custom_block_id']);
            $table->dropColumn('custom_block_id');
        });
    }
};
