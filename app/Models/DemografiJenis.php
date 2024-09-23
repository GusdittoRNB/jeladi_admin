<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemografiJenis extends Model
{
    use HasFactory;

    protected $table = 'demografi_jenis';
    protected $guarded = [];

    public function kelompok()
    {
        return $this->hasMany(DemografiKelompok::class, 'demografi_jenis_id');
    }
}
