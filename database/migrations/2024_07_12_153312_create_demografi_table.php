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
        Schema::create('demografi_jenis', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_demografi');
            $table->string('deskripsi')->nullable();
            $table->enum('publish', ['1', '0'])->default('0');
            $table->timestamps();
        });

        Schema::create('demografi_kelompok', function (Blueprint $table) {
            $table->id();
            $table->string('kelompok_demografi');
            $table->integer('jumlah');
            $table->string('color');
            $table->integer('demografi_jenis_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demografi_jenis');
        Schema::dropIfExists('demografi_kelompok');
    }
};
