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
            $table->string('photo')->nullable();
            $table->string('phone_number')->nullable();
            $table->enum('phone_number_priv', ['public', 'me'])->nullable();
            $table->string('facebook')->nullable();
            $table->enum('facebook_priv', ['public', 'me'])->nullable();
            $table->string('linkedin')->nullable();
            $table->enum('linkedin_priv', ['public', 'me'])->nullable();
            $table->enum('email_priv', ['public', 'me'])->nullable();
            $table->enum('gender', ['male', 'female', 'no profrence'])->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('birth_date_priv', ['public', 'me'])->nullable();
            $table->string('job')->nullable();
            $table->enum('job_priv', ['public', 'me'])->nullable();
            $table->string('education')->nullable();
            $table->enum('education_priv', ['public', 'me'])->nullable();
            $table->string('location')->nullable();
            $table->enum('location_priv', ['public', 'me'])->nullable();
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
