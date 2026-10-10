<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapter_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_chapter_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('featured_image')->nullable();

            // File handling
            $table->string('file_path')->nullable();
            $table->string('file_url')->nullable();
            $table->string('file_size')->nullable();
            $table->string('mime_type')->nullable();

            // Video handling
            $table->string('video_url')->nullable();
            $table->string('video_duration')->nullable();

            // Content Type
            $table->enum('type', ['text', 'pdf', 'video', 'audio', 'quiz', 'assignment'])->default('text');
            $table->integer('order')->default(0);
            $table->boolean('is_free_preview')->default(false);
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedBigInteger('downloads_count')->default(0);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('slug');
            $table->index('status');
            $table->index(['course_chapter_id', 'order']);
            $table->index('type');
            $table->fullText(['title', 'content', 'excerpt']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapter_notes');
    }
};
