<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GeografisDesa;
use Illuminate\Http\Request;

class GeografisDesacontroller extends Controller
{
    public function index(Request $request)
    {
        $geografis = GeografisDesa::where('publish', '1');

        if ($request->has('search')) {
            $geografis = $geografis->whereAny(['name', 'description'], 'ilike', '%'.$request->search.'%');
        }
        $geografis = $geografis->get();

        return response()->json([
            'geografis_desa' => $geografis,
            'success' => true
        ], 200);
    }
}
