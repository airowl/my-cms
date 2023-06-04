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
        Schema::table('local_translations', function (Blueprint $table) {
            $table->unsignedBigInteger('local_language_id')->nullable(true);
            $table->foreign('local_language_id')->references('id')->on('local_languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('local_translations', function (Blueprint $table) {
            $table->dropForeign(['local_language_id']);
            $table->dropColumn(['local_language_id']);
        });
    }
};
