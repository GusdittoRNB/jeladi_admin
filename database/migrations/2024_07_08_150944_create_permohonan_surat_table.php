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
        Schema::create('permohonan_surat', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('tanggal_permohonan');
            $table->integer('jenis_surat_id');
            $table->string('atas_nama_surat');
            $table->string('tujuan_permohonan');
            $table->string('tipe_surat');
            $table->string('status');
            $table->string('file_surat')->nullable();
            $table->integer('admin_id')->nullable();
            $table->text('history_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_surat');
    }
};
