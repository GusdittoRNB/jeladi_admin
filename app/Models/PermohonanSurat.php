<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $table = 'permohonan_surat';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    public static function tipeSuratList()
    {
        return [
            'hardcopy' => 'Hardcopy',
            'softcopy' => 'Softcopy'
        ];
    }

    public function getHumanTipeAttribute()
    {
        return static::tipeSuratList()[$this->tipe_surat];
    }

    public static function allowedTipe()
    {
        return array_keys(static::tipeSuratList());
    }

    public static function statusSuratList()
    {
        return [
            'diajukan' => 'Diajukan',
            'diterima' => 'Diterima',
            'menunggu' => 'Menunggu',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak'
        ];
    }

    public function getHumanStatusAttribute()
    {
        return static::statusSuratList()[$this->status];
    }

    public static function allowedStatus()
    {
        return array_keys(static::statusSuratList());
    }
}
