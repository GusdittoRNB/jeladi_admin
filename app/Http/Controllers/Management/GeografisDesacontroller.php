<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\GeografisDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeografisDesacontroller extends Controller
{
    public function index()
    {
        $geografis = GeografisDesa::all();
        return view('cms.admin.geografis-desa.index', compact('geografis'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'link' => 'required',
            'publish' => 'required|in:1,0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'add')
                ->withInput();
        }

        $data = $request->only('name', 'description', 'link', 'publish');
        GeografisDesa::create($data);

        \Session::flash('notification', ['level' => 'success', 'message' => 'Geografis desa telah ditambahkan']);
        return redirect()->route('geografis-desa.index');
    }

    public function edit($id)
    {
        $ggd = GeografisDesa::where('id', $id)->firstOrFail();
        return view('cms.admin.geografis-desa._edit', compact('ggd'))->render();
    }

    public function update(Request $request, $id)
    {
        $ggd = GeografisDesa::where('id', $id)->firstOrFail();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'link' => 'required',
            'publish' => 'required|in:1,0'
        ]);

        if ($validator->fails()) {
            \Session::flash('edit_fails_id', $id);
            return redirect()->back()
                ->withErrors($validator, 'edit')
                ->withInput();
        }

        $data = $request->only('name', 'description', 'link', 'publish');
        $ggd->update($data);

        \Session::flash('notification', ['level' => 'success', 'message' => 'Geografis desa telah diupdate']);
        return redirect()->route('geografis-desa.index');
    }

    public function delete(Request $request, $id)
    {
        $ggd = GeografisDesa::where('id', $id)->firstOrFail();
        $ggd->delete();

        \Session::flash('notification', ['level' => 'success', 'message' => 'Geografis desa telah dihapus']);
        return redirect()->route('geografis-desa.index');
    }
}
