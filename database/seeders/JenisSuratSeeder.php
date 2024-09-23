<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisSurat::create([
            'jenis_surat' => 'Dokumen Kependudukan',
            'aktif' => '1'
        ]);

        JenisSurat::create([
            'jenis_surat' => 'Surat Keterangan Usaha (SKU)',
            'aktif' => '1'
        ]);

        JenisSurat::create([
            'jenis_surat' => 'Surat Keterangan Domisili (SKD)',
            'aktif' => '1'
        ]);

        JenisSurat::create([
            'jenis_surat' => 'Kredit Usaha Rakyat (KUR) Terkait Perekonomian',
            'aktif' => '1'
        ]);

        JenisSurat::create([
            'jenis_surat' => 'Surat Keterangan Tidak Mampu (SKTM)',
            'aktif' => '1'
        ]);

        JenisSurat::create([
            'jenis_surat' => 'Surat Lainnya',
            'aktif' => '1'
        ]);
    }
}
