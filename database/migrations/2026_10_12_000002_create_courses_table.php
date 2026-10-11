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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('level')->default('Beginner'); // Beginner, Intermediate, Advanced
            $table->string('language')->default('English');
            $table->foreignId('instructor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('duration')->nullable(); // e.g. '52h' or '4 weeks'
            $table->text('learning_objectives')->nullable();
            $table->text('prerequisites')->nullable();
            $table->string('type')->default('Free'); // Free, Paid
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->string('preview_video_url')->nullable();
            $table->string('preview_video_path')->nullable();
            $table->string('preview_video_thumbnail')->nullable();
            $table->string('status')->default('Draft'); // Draft, Published, Archived
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
