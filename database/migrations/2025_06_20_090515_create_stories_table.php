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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->constrained('talents')->onDelete('cascade');
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('media')->nullable(); // image/video URL or file path
            $table->string('thumbnail')->nullable(); // thumbnail image URL or file path
            $table->string('slug')->unique(); // URL-friendly version of the title
            $table->string('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('tags')->nullable(); // comma-separated tags
            $table->enum('status', ['draft', 'published','archived'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
