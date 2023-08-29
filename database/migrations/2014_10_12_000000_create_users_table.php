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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // New field
            $table->string('last_name'); // New field
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address'); // New field
            $table->string('zip'); // New field
            $table->string('city'); // New field
            $table->string('country'); // New field
            $table->date('birth_date'); // New field
            $table->string('phone_number'); // New field
            $table->rememberToken();
            $table->timestamps();
    });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }

};
