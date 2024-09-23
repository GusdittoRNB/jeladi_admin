<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\DemografiJenis;
use App\Models\GeografisDesa;
use App\Models\PermohonanSurat;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function dashboard(): View {
        $permohonanSurat = PermohonanSurat::where('status', 'diajukan')->get();
        $geografisDesa = GeografisDesa::where('publish', '1')->orderBy('updated_at', 'desc')->limit(5)->get();
        $layananKesehatan = Article::where('tipe', 'layanan-kesehatan')->where('publish', '1')->orderBy('updated_at', 'desc')->limit(5)->get();
        $demografiJenis = DemografiJenis::where('publish', '1')->orderBy('updated_at', 'desc')->limit(7)->get();
        return view('cms.admin.home.index', compact('permohonanSurat', 'geografisDesa', 'layananKesehatan', 'demografiJenis'));
    }

    public function article($id)
    {
        $layananKesehatan = Article::where('tipe', 'layanan-kesehatan')->where('publish', '1')->where('id', $id)->firstOrFail();
        return view('cms.admin.home.detail-article', compact('layananKesehatan'));
    }

    public function demografi($id)
    {
        $demografiJenis = DemografiJenis::where('publish', '1')->where('id', $id)->firstOrFail();
        return view('cms.admin.home._demografi-kelompok', compact('demografiJenis'))->render();
    }
}
