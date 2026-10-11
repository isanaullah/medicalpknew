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
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_page_id')->constrained('website_pages')->cascadeOnDelete();
            $table->string('section_key');                   // stable identifier e.g. "hero", "stats", "mission"
            $table->string('title')->nullable();             // section heading
            $table->string('subtitle')->nullable();          // eyebrow / small heading
            $table->text('description')->nullable();         // lead paragraph
            $table->longText('body')->nullable();            // rich body content (HTML)
            $table->json('config')->nullable();              // flexible JSON for buttons, images, items list, etc.
            $table->string('image')->nullable();             // section image URL
            $table->boolean('is_visible')->default(true);    // visibility toggle
            $table->integer('sort_order')->default(0);       // section ordering
            $table->timestamps();

            $table->unique(['website_page_id', 'section_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
