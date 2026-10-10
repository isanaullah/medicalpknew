<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('youtube_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('video_url'); // YouTube video URL
            $table->string('video_id')->nullable(); // YouTube video ID
            $table->string('subject')->nullable();
            $table->string('thumbnail')->nullable(); // Custom thumbnail
            $table->string('views')->nullable(); // View count display
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('youtube_videos');
    }
};
