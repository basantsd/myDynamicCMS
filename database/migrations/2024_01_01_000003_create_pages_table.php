<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('template')->default('default'); // default, home, contact, etc.
            $table->boolean('is_published')->default(false);
            $table->boolean('show_in_menu')->default(true);
            $table->integer('menu_order')->default(0);
            $table->foreignId('parent_id')->nullable()->constrained('pages')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
