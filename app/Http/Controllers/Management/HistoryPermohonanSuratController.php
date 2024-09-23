<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\HistoryPermohonanSurat;
use App\Models\PermohonanSurat;
use Illuminate\Http\Request;

class HistoryPermohonanSuratController extends Controller
{
    public function index()
    {
        $permohonanSurat = HistoryPermohonanSurat::whereIn('status', ['disetujui', 'ditolak'])->get();
        return view('cms.admin.surat.history-permohonan-surat.index', compact('permohonanSurat'));
    }

    public function detail($id)
    {
        $surat = HistoryPermohonanSurat::where('id', $id)->whereIn('status', ['disetujui', 'ditolak'])->firstOrFail();
        return view('cms.admin.surat.history-permohonan-surat.detail', compact('surat'));
    }
}
