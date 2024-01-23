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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('phone_number');
            $table->enum('phone_number_priv', ['public', 'me']);
            $table->string('facebook');
            $table->enum('facebook_priv', ['public', 'me']);
            $table->string('linkedin');
            $table->enum('linkedin_priv', ['public', 'me']);
            $table->enum('email_priv', ['public', 'me']);
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');
            $table->enum('birth_date_priv', ['public', 'me']);
            $table->date('job');
            $table->enum('job_priv', ['public', 'me']);
            $table->date('education');
            $table->enum('education_priv', ['public', 'me']);
            $table->date('location');
            $table->enum('location_priv', ['public', 'me']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
