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
        Schema::create('iseeyou_sections', function (Blueprint $table) {
            $table->id();
              $table->string('heading')->nullable();
            $table->text('description')->nullable();
            $table->string('video')->nullable();
            $table->text('video_link')->nullable();
            $table->string('button_text')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iseeyou_section');
    }
};
