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
        Schema::table('users', function (Blueprint $table) {
            $table->string('usersubscription_id')->nullable()->after('is_artist');
            $table->timestamp('usersubscription_date')->nullable()->after('usersubscription_id');
            $table->integer('usersubscription_duration')->nullable()->after('usersubscription_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['usersubscription_id', 'usersubscription_date', 'usersubscription_duration']);
        });
    }
};
