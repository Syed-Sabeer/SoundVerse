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
        Schema::table('social_share_musics', function (Blueprint $table) {
            $table->boolean('visibility')->default(1)->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_share_musics', function (Blueprint $table) {
            $table->dropColumn('visibility');
        });
    }
};
