<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DemografiJenis;
use App\Models\DemografiKelompok;
use Illuminate\Http\Request;

class DemografiController extends Controller
{
    public function index(Request $request)
    {
        $jenisDemografi = DemografiJenis::where('publish', '1');

        if ($request->has('search')) {
            $jenisDemografi = $jenisDemografi->whereAny(['jenis_demografi', 'deskripsi'], 'ilike', '%'.$request->search.'%');
        }
        $jenisDemografi = $jenisDemografi->select('id', 'jenis_demografi', 'deskripsi')->get();

        $demografi = [];
        foreach ($jenisDemografi as $jd) {
            $dmg = $jd;
            $dmg['kelompok'] = $jd->kelompok()->select('id', 'kelompok_demografi', 'jumlah', 'color', 'order_number')->orderBy('order_number')->get();
            array_push($demografi, $dmg);
        }
        return response()->json([
            'demografi' => $demografi,
            'success' => true
        ], 200);
    }

    public function detail(Request $request, $id)
    {
        $jenisDemografi = DemografiJenis::where('publish', '1')->where('id', $id)->select('id', 'jenis_demografi', 'deskripsi')->first();

        if (!empty($jenisDemografi)) {
            $kelompokDemografi = DemografiKelompok::where('demografi_jenis_id', $jenisDemografi->id);
            if ($request->has('search')) {
                $kelompokDemografi = $kelompokDemografi->where('kelompok_demografi', 'ilike', '%'.$request->search.'%');
            }
            $kelompokDemografi = $kelompokDemografi->select('id', 'kelompok_demografi', 'jumlah', 'color', 'order_number')->orderBy('order_number')->get();
            $jenisDemografi['kelompok'] = $kelompokDemografi;

            return response()->json([
                'demografi' => $jenisDemografi,
                'message' => 'Data demografi berhasil ditemukan',
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'demografi' => null,
                'message' => 'Data demografi tidak ditemukan',
                'success' => false
            ], 404);
        }
    }
}
