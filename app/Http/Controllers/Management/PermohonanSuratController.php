<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Service\UploadFileSurat;
use App\Http\Service\UserProfileService;
use App\Models\HistoryPermohonanSurat;
use App\Models\PermohonanSurat;
use App\Notifications\SuratSoftcopyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanSuratController extends Controller
{
    public function index()
    {
        $permohonanSurat = PermohonanSurat::whereIn('status', ['diajukan', 'diterima', 'menunggu'])->get();
        return view('cms.admin.surat.permohonan-surat.index', compact('permohonanSurat'));
    }

    public function detail($id)
    {
        $surat = PermohonanSurat::where('id', $id)->whereIn('status', ['diajukan', 'diterima', 'menunggu'])->firstOrFail();
        return view('cms.admin.surat.permohonan-surat.detail', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:'.implode(',', PermohonanSurat::allowedStatus()),
        ]);

        $user = Auth::user();
        $surat = PermohonanSurat::where('id', $id)->whereIn('status', ['diajukan', 'diterima', 'menunggu'])->firstOrFail();
        if ($request->status == 'ditolak') {
            $request->validate([
                'alasan_ditolak' => 'required'
            ]);
        } elseif ($request->status == 'disetujui' && $surat->tipe_surat == 'softcopy' && $surat->file_surat == '') {
            $request->validate([
                'file_surat' => 'required|mimes:pdf'
            ]);
        }

        if ($request->status == 'diajukan') {
            $dataSurat = [];
            $dataSurat['status'] = $request->status;
            $dataSurat['admin_id'] = $user->id;

            if ($request->hasFile('file_surat')) {
                $request->validate([
                    'file_surat' => 'mimes:pdf'
                ]);

                $uploadSuratService = new UploadFileSurat();
                $dataSurat['file_surat'] = $uploadSuratService->uploadFileSurat($request->file_surat, $surat);
                if ('' !== $surat->file_surat) {
                    $uploadSuratService->deleteFileSurat($surat->file_surat);
                }
            }

            $surat->update($dataSurat);

            \Session::flash('notification', ['level' => 'success', 'message' => 'Permohonan surat telah di update']);
            return redirect()->route('surat.permohonan.index');
        } elseif (in_array($request->status, ['diterima', 'menunggu'])) {
            $dataSurat = [];
            $dataSurat['status'] = $request->status;
            $dataSurat['admin_id'] = $user->id;

            if ($request->hasFile('file_surat')) {
                $request->validate([
                    'file_surat' => 'mimes:pdf'
                ]);

                $uploadSuratService = new UploadFileSurat();
                $dataSurat['file_surat'] = $uploadSuratService->uploadFileSurat($request->file_surat, $surat);
                if ('' !== $surat->file_surat) {
                    $uploadSuratService->deleteFileSurat($surat->file_surat);
                }
            }

            $statusSurat = json_decode($surat->history_status, true);
            if ($request->status == 'diterima') {
                $statusSurat['diterima'] = [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_phone' => $user->phone,
                    'user_email' => $user->email,
                    'date_time' => date('Y-m-d H:i:s'),
                    'status' => 'diterima'
                ];
            } elseif ($request->status == 'menunggu') {
                if (!array_key_exists('diterima', $statusSurat)) {
                    $statusSurat['diterima'] = [
                        'user_id' => $user->id,
                        'user_name' => $user->name,
                        'user_phone' => $user->phone,
                        'user_email' => $user->email,
                        'date_time' => date('Y-m-d H:i:s'),
                        'status' => 'diterima'
                    ];
                }

                $statusSurat['menunggu'] = [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_phone' => $user->phone,
                    'user_email' => $user->email,
                    'date_time' => date('Y-m-d H:i:s'),
                    'status' => 'menunggu'
                ];
            }
            $dataSurat['history_status'] = json_encode($statusSurat);

            $surat->update($dataSurat);

            \Session::flash('notification', ['level' => 'success', 'message' => 'Status surat telah di update']);
            return redirect()->route('surat.permohonan.index');

        } elseif (in_array($request->status, ['ditolak', 'disetujui'])) {
            $statusSurat = json_decode($surat->history_status, true);

            $dataSurat = $surat->only('id', 'user_id', 'tanggal_permohonan', 'jenis_surat_id', 'atas_nama_surat', 'tujuan_permohonan', 'tipe_surat', 'file_surat', 'created_at', 'updated_at');
            $dataSurat['status'] = $request->status;
            $dataSurat['user_nik'] = $surat->user->nik;
            $dataSurat['user_name'] = $surat->user->name;
            $dataSurat['user_alamat'] = $surat->user->address;
            $dataSurat['user_phone'] = $surat->user->phone;
            $dataSurat['jenis_surat'] = $surat->jenis_surat->jenis_surat;
            $dataSurat['admin_id'] = $user->id;
            $dataSurat['admin_name'] = $user->name;

            if ($request->status == 'ditolak') {
                $dataSurat['alasan_ditolak'] = $request->alasan_ditolak;


                $statusSurat['ditolak'] = [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_phone' => $user->phone,
                    'user_email' => $user->email,
                    'date_time' => date('Y-m-d H:i:s'),
                    'status' => 'ditolak'
                ];
                $dataSurat['history_status'] = json_encode($statusSurat);

                HistoryPermohonanSurat::create($dataSurat);
                $surat->delete();

                \Session::flash('notification', ['level' => 'success', 'message' => 'Permohonan surat telah ditolak']);
                return redirect()->route('surat.history-permohonan.index');
            } elseif ($request->status == 'disetujui') {
                $dataSurat['alasan_ditolak'] = '';

                if ($request->hasFile('file_surat')) {
                    $request->validate([
                        'file_surat' => 'mimes:pdf'
                    ]);

                    $uploadSuratService = new UploadFileSurat();
                    $dataSurat['file_surat'] = $uploadSuratService->uploadFileSurat($request->file_surat, $surat);
                    if ('' !== $surat->file_surat) {
                        $uploadSuratService->deleteFileSurat($surat->file_surat);
                    }
                }

                if (!array_key_exists('diterima', $statusSurat)) {
                    $statusSurat['diterima'] = [
                        'user_id' => $user->id,
                        'user_name' => $user->name,
                        'user_phone' => $user->phone,
                        'user_email' => $user->email,
                        'date_time' => date('Y-m-d H:i:s'),
                        'status' => 'diterima'
                    ];
                }

                if (!array_key_exists('menunggu', $statusSurat)) {
                    $statusSurat['menunggu'] = [
                        'user_id' => $user->id,
                        'user_name' => $user->name,
                        'user_phone' => $user->phone,
                        'user_email' => $user->email,
                        'date_time' => date('Y-m-d H:i:s'),
                        'status' => 'menunggu'
                    ];
                }

                $statusSurat['disetujui'] = [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_phone' => $user->phone,
                    'user_email' => $user->email,
                    'date_time' => date('Y-m-d H:i:s'),
                    'status' => 'disetujui'
                ];
                $dataSurat['history_status'] = json_encode($statusSurat);

                $historySurat = HistoryPermohonanSurat::create($dataSurat);
                $surat->delete();

                if ($historySurat->tipe_surat == 'softcopy') {
                    $user = $historySurat->user;
                    $user->notify(new SuratSoftcopyNotification($user, $historySurat));
                }

                \Session::flash('notification', ['level' => 'success', 'message' => 'Permohonan surat telah disetujui']);
                return redirect()->route('surat.history-permohonan.index');
            }
        }

        return redirect()->back();
    }
}
