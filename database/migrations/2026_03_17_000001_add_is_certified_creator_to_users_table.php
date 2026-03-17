<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'is_certified_creator')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_certified_creator')->default(false)->after('is_artist');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'is_certified_creator')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_certified_creator');
            });
        }
    }
};
