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
        Schema::create('custom_block_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained('custom_blocks')->onDelete('cascade');
            $table->string('variant_name');
            $table->json('variant_config');
            $table->longText('html_template')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            // Indexes for performance
            $table->index('block_id');
            $table->index('is_default');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_block_variants');
    }
};
