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
        Schema::create('monthly_plays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('music_id');
            $table->integer('plays')->default(0);
            $table->integer('month');
            $table->integer('year');
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('music_id')->references('id')->on('artist_musics')->onDelete('cascade');
            
            // Unique constraint to prevent duplicate entries for same user, music, month, year
            $table->unique(['user_id', 'music_id', 'month', 'year'], 'unique_user_music_month_year');
            
            // Indexes for better performance
            $table->index(['user_id', 'month', 'year']);
            $table->index(['music_id', 'month', 'year']);
            $table->index(['month', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_plays');
    }
};