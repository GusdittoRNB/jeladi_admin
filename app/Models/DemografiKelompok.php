<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemografiKelompok extends Model
{
    use HasFactory;

    protected $table = 'demografi_kelompok';
    protected $guarded = [];

    public function jenis()
    {
        return $this->belongsTo(DemografiJenis::class, 'demografi_jenis_id');
    }
}
