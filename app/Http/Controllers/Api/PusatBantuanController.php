<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WebConfig;
use Illuminate\Http\Request;

class PusatBantuanController extends Controller
{
    public function index()
    {
        $webfig = WebConfig::whereIn('key', ['whatsapp', 'email', 'telepon'])->where('publish', '1')->get();

        $dataPusatBantuan = [];
        foreach ($webfig as $wf) {
            $dataPusatBantuan[$wf->key] = $wf->value;
        }

        return response()->json([
            'pusat_bantuan' => $dataPusatBantuan,
            'success' => true
        ], 200);
    }
}
