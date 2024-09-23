<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\DemografiJenis;
use App\Models\DemografiKelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemografiKelompokController extends Controller
{
    public function index($id)
    {
        $jenisDemografi = DemografiJenis::where('id', $id)->firstOrFail();
        $maxNumber = $jenisDemografi->kelompok()->max('order_number');
        $kelompokDemografi = DemografiKelompok::where('demografi_jenis_id', $jenisDemografi->id)->get();
        return view('cms.admin.demografi.kelompok.index', compact('jenisDemografi', 'kelompokDemografi', 'maxNumber'));
    }

    public function store(Request $request, $id)
    {
        $jenisDemografi = DemografiJenis::where('id', $id)->firstOrFail();
        $validator = Validator::make($request->all(), [
            'kelompok_demografi' => 'required',
            'jumlah' => 'required|integer',
            'color' => 'required',
            'order_number' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'add')
                ->withInput();
        }

        $data = $request->only('kelompok_demografi', 'jumlah', 'color', 'order_number');
        $data['demografi_jenis_id'] = $jenisDemografi->id;
        DemografiKelompok::create($data);

        \Session::flash('notification', ['level' => 'success', 'message' => 'Kelompok demografi telah ditambahkan']);
        return redirect()->route('demografi.kelompok.index', $jenisDemografi->id);
    }

    public function edit($id)
    {
        $kd = DemografiKelompok::where('id', $id)->firstOrFail();
        return view('cms.admin.demografi.kelompok._edit', compact('kd'))->render();
    }

    public function update(Request $request, $id)
    {
        $kd = DemografiKelompok::where('id', $id)->firstOrFail();
        $validator = Validator::make($request->all(), [
            'kelompok_demografi' => 'required',
            'jumlah' => 'required|integer',
            'color' => 'required',
            'order_number' => 'required|integer'
        ]);

        if ($validator->fails()) {
            \Session::flash('edit_fails_id', $id);
            return redirect()->back()
                ->withErrors($validator, 'edit')
                ->withInput();
        }

        $data = $request->only('kelompok_demografi', 'jumlah', 'color', 'order_number');
        $kd->update($data);

        \Session::flash('notification', ['level' => 'success', 'message' => 'Kelompok demografi telah diupdate']);
        return redirect()->route('demografi.kelompok.index', $kd->demografi_jenis_id);
    }

    public function delete(Request $request, $id)
    {
        $kd = DemografiKelompok::where('id', $id)->firstOrFail();
        $kdId = $kd->demografi_jenis_id;
        $kd->delete();

        \Session::flash('notification', ['level' => 'success', 'message' => 'Kelompok demografi telah dihapus']);
        return redirect()->route('demografi.kelompok.index', $kdId);
    }
}
