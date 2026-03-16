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
        Schema::create('home_hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();
            $table->text('button_link')->nullable();
            $table->text('bg_image')->nullable();
            $table->text('song_image')->nullable();
            $table->text('song_name')->nullable();
            $table->string('song_album')->nullable();
            $table->text('song')->nullable();
            $table->text('pc_image_1')->nullable();
            $table->text('pc_image_2')->nullable();
            $table->text('pc_image_3')->nullable();
            $table->text('pc_image_4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_hero_sections');
    }
};
