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
        Schema::create('history_permohonan_surat', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('user_id');
            $table->string('user_nik');
            $table->string('user_name');
            $table->string('user_alamat');
            $table->string('user_phone');
            $table->date('tanggal_permohonan');
            $table->integer('jenis_surat_id');
            $table->string('jenis_surat');
            $table->string('atas_nama_surat');
            $table->string('tujuan_permohonan');
            $table->string('tipe_surat');
            $table->string('status');
            $table->string('alasan_ditolak')->nullable();
            $table->string('file_surat')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('admin_name')->nullable();
            $table->text('history_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_permohonan_surat');
    }
};
