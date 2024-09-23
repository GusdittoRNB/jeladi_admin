<?php

namespace Database\Seeders;

use App\Models\DemografiJenis;
use App\Models\DemografiKelompok;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemografiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pekerjaan = DemografiJenis::create([
            'jenis_demografi' => 'Pekerjaan',
            'deskripsi' => 'Informasi data pekerjaan penduduk Desa Jehem',
            'publish' => '1'
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Belum/Tidak Bekerja',
            'jumlah' => 2085,
            'color' => '#7CB5EC',
            'demografi_jenis_id' => $pekerjaan->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Pensiunan',
            'jumlah' => 2085,
            'color' => '#F7A35C',
            'demografi_jenis_id' => $pekerjaan->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Kepolisian RI (POLRI)',
            'jumlah' => 2085,
            'color' => '#E4D354',
            'demografi_jenis_id' => $pekerjaan->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Peternak',
            'jumlah' => 2085,
            'color' => '#91E8E1',
            'demografi_jenis_id' => $pekerjaan->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Karyawan BUMN',
            'jumlah' => 2085,
            'color' => '#F15C80',
            'demografi_jenis_id' => $pekerjaan->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Konstruksi',
            'jumlah' => 2085,
            'color' => '#90ED7D',
            'demografi_jenis_id' => $pekerjaan->id
        ]);

        $agama = DemografiJenis::create([
            'jenis_demografi' => 'Agama',
            'deskripsi' => 'Informasi data agama penduduk Desa Jehem',
            'publish' => '1'
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Hindu',
            'jumlah' => 8000,
            'color' => '#FAC153',
            'demografi_jenis_id' => $agama->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Islam',
            'jumlah' => 50,
            'color' => '#7CB5EC',
            'demografi_jenis_id' => $agama->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Kristen',
            'jumlah' => 50,
            'color' => '#263238',
            'demografi_jenis_id' => $agama->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Khatolik',
            'jumlah' => 0,
            'color' => '#7EF6BB',
            'demografi_jenis_id' => $agama->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Budha',
            'jumlah' => 20,
            'color' => '#8085E9',
            'demografi_jenis_id' => $agama->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Khonghucu',
            'jumlah' => 0,
            'color' => '#F15C80',
            'demografi_jenis_id' => $agama->id
        ]);

        $jeniskelamin = DemografiJenis::create([
            'jenis_demografi' => 'Jenis Kelamin',
            'deskripsi' => 'Informasi data jenis kelamin penduduk Desa Jehem',
            'publish' => '1'
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Laki-laki',
            'jumlah' => 2085,
            'color' => '#7CB5EC',
            'demografi_jenis_id' => $jeniskelamin->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Perempuan',
            'jumlah' => 2085,
            'color' => '#ED0677',
            'demografi_jenis_id' => $jeniskelamin->id
        ]);

        $warganegara = DemografiJenis::create([
            'jenis_demografi' => 'Warga Negara',
            'deskripsi' => 'Informasi data warga negara penduduk Desa Jehem',
            'publish' => '1'
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => 'Di bawah 1 tahun',
            'jumlah' => 2085,
            'color' => '#7CB5EC',
            'demografi_jenis_id' => $warganegara->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => '2 s/d 4 tahun',
            'jumlah' => 2085,
            'color' => '#434348',
            'demografi_jenis_id' => $warganegara->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => '5 s/d 9 tahun',
            'jumlah' => 2085,
            'color' => '#E4D354',
            'demografi_jenis_id' => $warganegara->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => '10 s/d 14 tahun',
            'jumlah' => 2085,
            'color' => '#434348',
            'demografi_jenis_id' => $warganegara->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => '20 s/d 24 tahun',
            'jumlah' => 2085,
            'color' => '#F15C80',
            'demografi_jenis_id' => $warganegara->id
        ]);

        DemografiKelompok::create([
            'kelompok_demografi' => '45 s/d 49 tahun',
            'jumlah' => 2085,
            'color' => '#7CB5EC',
            'demografi_jenis_id' => $warganegara->id
        ]);
    }
}
