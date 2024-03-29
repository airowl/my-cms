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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parentId')->nullable(true);
            $table->string('title');
            $table->string('metaTitle')->nullable(true);
            $table->string('slug')->nullable(true);
            $table->tinyText('summury')->nullable(true);
            $table->tinyInteger('published')->nullable(true);
            $table->dateTime('publishedAt')->nullable(true);
            $table->text('content')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
