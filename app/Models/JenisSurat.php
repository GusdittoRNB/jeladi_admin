<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    protected $table = 'jenis_surat';
    protected $guarded = [];

    public function permohonan_surat()
    {
        return $this->hasMany(PermohonanSurat::class, 'jenis_surat_id');
    }

    public function history_permohonan_surat()
    {
        return $this->hasMany(HistoryPermohonanSurat::class, 'jenis_surat_id');
    }
}
