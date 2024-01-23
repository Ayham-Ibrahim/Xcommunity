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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->text('body');
            $table->text('time_to_read');
            $table->foreignId('child_category_id')->constrained('child_categories')->cascadeOnDelete();;
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->foreignId('article_group_id')->constrained('article_groups')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
