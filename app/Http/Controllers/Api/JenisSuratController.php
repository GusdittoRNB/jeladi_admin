<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index()
    {
        $jenisSurat = JenisSurat::where('aktif', '1')->get();
        return response()->json([
            'jenis_surat' => $jenisSurat->select('id', 'jenis_surat'),
            'success' => true
        ], 200);
    }
}
