<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\DemografiJenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemografiJenisController extends Controller
{
    public function index()
    {
        $jenisDemografi = DemografiJenis::all();
        return view('cms.admin.demografi.jenis.index', compact('jenisDemografi'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_demografi' => 'required',
            'deskripsi' => 'required',
            'publish' => 'required|in:1,0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'add')
                ->withInput();
        }

        $data = $request->only('jenis_demografi', 'deskripsi', 'publish');
        DemografiJenis::create($data);

        \Session::flash('notification', ['level' => 'success', 'message' => 'Jenis demografi telah ditambahkan']);
        return redirect()->route('demografi.jenis.index');
    }

    public function edit($id)
    {
        $jd = DemografiJenis::where('id', $id)->firstOrFail();
        return view('cms.admin.demografi.jenis._edit', compact('jd'))->render();
    }

    public function update(Request $request, $id)
    {
        $jd = DemografiJenis::where('id', $id)->firstOrFail();
        $validator = Validator::make($request->all(), [
            'jenis_demografi' => 'required',
            'deskripsi' => 'required',
            'publish' => 'required|in:1,0'
        ]);

        if ($validator->fails()) {
            \Session::flash('edit_fails_id', $id);
            return redirect()->back()
                ->withErrors($validator, 'edit')
                ->withInput();
        }

        $data = $request->only('jenis_demografi', 'deskripsi', 'publish');
        $jd->update($data);

        \Session::flash('notification', ['level' => 'success', 'message' => 'Jenis demografi telah diupdate']);
        return redirect()->route('demografi.jenis.index');
    }

    public function delete(Request $request, $id)
    {
        $jd = DemografiJenis::where('id', $id)->firstOrFail();
        $jd->delete();

        \Session::flash('notification', ['level' => 'success', 'message' => 'Jenis demografi telah dihapus']);
        return redirect()->route('demografi.jenis.index');
    }
}
