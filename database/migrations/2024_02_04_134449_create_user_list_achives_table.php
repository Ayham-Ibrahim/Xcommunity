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
        Schema::create('user_list_archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_list_id')->constrained('user_lists')->cascadeOnDelete();
            $table->morphs('saveable');
            $table->enum('reaction', ['save', 'unsave']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_list_achives');
    }
};
