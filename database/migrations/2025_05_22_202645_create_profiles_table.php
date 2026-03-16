<?php

use App\Models\Country;
use App\Models\Designation;
use App\Models\Gender;
use App\Models\Language;
use App\Models\MaritalStatus;
use App\Models\User;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
          $table->string('first_name')->nullable();
$table->string('last_name')->nullable();
$table->string('phone')->nullable();
$table->string('company_name')->nullable();
$table->string('contact_person')->nullable();
$table->string('company_phone')->nullable();
$table->string('company_type')->nullable();
$table->string('company_size')->nullable();
$table->string('dance_style')->nullable();
$table->string('dance_video')->nullable();
$table->string('picture')->nullable();
$table->text('about')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
