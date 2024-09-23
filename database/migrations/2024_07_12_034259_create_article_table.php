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
        Schema::create('article', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_description')->nullable();
            $table->text('conten');
            $table->string('tipe');
            $table->enum('publish', ['1', '0'])->default('0');
            $table->timestamps();
        });

        Schema::create('article_image', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->integer('article_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article');
        Schema::dropIfExists('article_image');
    }
};
