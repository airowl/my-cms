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
            $table->string('firstName');
            $table->string('middleName')->nullable(true);
            $table->string('lastName')->nullable(true);
            $table->string('phone_number')->nullable(true);
            $table->string('email')->unique();
            $table->text('avatar')->nullable(true);
            $table->enum('status', ['inactive', 'active']);
            $table->timestamp('registeredAt')->nullable(true);
            $table->timestamp('lastLogin')->nullable(true);
            $table->text('intro')->nullable(true);
            $table->string('language')->nullable(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
