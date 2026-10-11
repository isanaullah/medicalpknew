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
        Schema::table('quizzes', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
