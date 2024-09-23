<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryPermohonanSurat;
use App\Models\PermohonanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermohonanSuratController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $permohonanSurat = PermohonanSurat::join('users', 'permohonan_surat.user_id', '=', 'users.id')
                ->join('jenis_surat', 'permohonan_surat.jenis_surat_id', '=', 'jenis_surat.id')
                ->where('permohonan_surat.user_id', $user->id)
                ->orderBy('permohonan_surat.tanggal_permohonan', 'desc')
                ->selectRaw('permohonan_surat.id, user_id, users.nik AS user_nik, users.name AS user_name, users.address AS user_alamat, users.phone AS user_phone, tanggal_permohonan, jenis_surat_id, jenis_surat.jenis_surat, atas_nama_surat, tujuan_permohonan, tipe_surat, permohonan_surat.status, null as alasan_ditolak, file_surat, permohonan_surat.created_at, permohonan_surat.updated_at')
                ->get();

        $historyPermohonanSurat = HistoryPermohonanSurat::where('user_id', $user->id)
                ->select('id', 'user_id', 'user_nik', 'user_name', 'user_alamat', 'user_phone', 'tanggal_permohonan', 'jenis_surat_id', 'jenis_surat', 'atas_nama_surat', 'tujuan_permohonan', 'tipe_surat', 'status', 'alasan_ditolak', 'file_surat', 'created_at', 'updated_at')
                ->orderBy('tanggal_permohonan', 'desc')
                ->get();

        $mergeSurat = $permohonanSurat->merge($historyPermohonanSurat);

        $dataSurat = [];
        foreach ($mergeSurat as $mrSurat) {
            $mrSurat['file_surat'] = $mrSurat->file_surat != '' ? url('storage/permohonan-surat/'.$mrSurat->file_surat) : '';
            array_push($dataSurat, $mrSurat);
        }

        return response()->json([
            'data_surat' => $dataSurat,
            'message' => count($dataSurat) > 0 ? 'Data permohonan surat berhasil ditemukan' : 'Data permohonan masih kosong',
            'success' => true
        ], 200);
    }

    public function detail($id)
    {
        $user = Auth::user();
        $permohonanSurat = PermohonanSurat::where('user_id', $user->id)->where('id', $id)->first();

        if (!empty($permohonanSurat)) {
            $dataSurat = $permohonanSurat->only('id', 'user_id', 'tanggal_permohonan', 'jenis_surat_id', 'atas_nama_surat', 'tujuan_permohonan', 'tipe_surat', 'status', 'file_surat', 'created_at', 'updated_at');
            $dataSurat['user_nik'] = $permohonanSurat->user->nik;
            $dataSurat['user_name'] = $permohonanSurat->user->name;
            $dataSurat['user_alamat'] = $permohonanSurat->user->address;
            $dataSurat['user_phone'] = $permohonanSurat->user->phone;
            $dataSurat['jenis_surat'] = $permohonanSurat->jenis_surat->jenis_surat;
            $dataSurat['file_surat'] = $permohonanSurat->file_surat != '' ? url('storage/permohonan-surat/'.$permohonanSurat->file_surat) : '';

            return response()->json([
                'data_surat' => $dataSurat,
                'message' => 'Data permohonan surat berhasil ditemukan',
                'success' => true
            ], 200);
        } else {
            $historyPermohonanSurat = HistoryPermohonanSurat::where('user_id', $user->id)
                ->where('id', $id)
                ->select('id', 'user_id', 'user_nik', 'user_name', 'user_alamat', 'user_phone', 'tanggal_permohonan', 'jenis_surat_id', 'jenis_surat', 'atas_nama_surat', 'tujuan_permohonan', 'tipe_surat', 'status', 'alasan_ditolak', 'file_surat', 'created_at', 'updated_at')
                ->first();
            $historyPermohonanSurat['file_surat'] = $historyPermohonanSurat->file_surat != '' ? url('storage/permohonan-surat/'.$historyPermohonanSurat->file_surat) : '';

            if (!empty($historyPermohonanSurat)) {
                return response()->json([
                    'data_surat' => $historyPermohonanSurat,
                    'message' => 'Data permohonan surat berhasil ditemukan',
                    'success' => true
                ], 200);
            } else {
                return response()->json([
                    'data_surat' => null,
                    'message' => 'Data permohonan surat tidak ditemukan',
                    'success' => false
                ], 404);
            }
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'atas_nama_surat' => 'required',
            'tujuan_permohonan' => 'required',
            'tipe_surat' => 'required|in:hardcopy,softcopy'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
                'success' => false
            ], 200);
        }

        $user = Auth::user();
        $dataPermohonan = $request->only('jenis_surat_id', 'atas_nama_surat', 'tujuan_permohonan', 'tipe_surat');
        $dataPermohonan['user_id'] = $user->id;
        $dataPermohonan['tanggal_permohonan'] = date('Y-m-d');
        $dataPermohonan['status'] = 'diajukan';

        $dataStatus = [];
        $dataStatus['diajukan'] = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_phone' => $user->phone,
            'user_email' => $user->email,
            'date_time' => date('Y-m-d H:i:s'),
            'status' => 'diajukan'
        ];
        $dataPermohonan['history_status'] = json_encode($dataStatus);

        $permohonan = PermohonanSurat::create($dataPermohonan);
        return response()->json([
            'message' => 'Permohonan surat telah diajukan',
            'success' => true
        ], 200);
    }
}
