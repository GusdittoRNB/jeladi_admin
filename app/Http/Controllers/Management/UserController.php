<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Imports\ImportEndUser;
use App\Models\PermohonanSurat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        $users = User::where('role', 'user')->get();
        return view('cms.admin.usermanagement.enduser.index', compact('users'));
    }

    public function store(Request $request) {
        if (!Gate::allows('be_super_admin') && !Gate::allows('be_admin')) {
            abort(403, 'Unauthorized action');
        }

        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:users,nik',
            'name' => 'required',
            'gender' => 'required|in:L,P',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed|min:8',
            'status' => 'required|in:active,suspend'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'add')
                ->withInput();
        }

        $datauser = $request->only('nik','name', 'gender', 'email', 'phone', 'address', 'status');
        $datauser['password'] = Hash::make($request->password);
        $datauser['role'] = 'user';
        $user = User::create($datauser);

        \Session::flash('notification', ['level' => 'success', 'message' => 'User telah ditambahkan']);
        return redirect()->route('usermanagement.enduser.index');
    }

    public function edit($id)
    {
        $user = User::where('role', 'user')->where('id', $id)->firstOrFail();
        return view('cms.admin.usermanagement.enduser._edit', compact('user'))->render();
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('be_super_admin') && !Gate::allows('be_admin')) {
            abort(403, 'Unauthorized action');
        }
        $user = User::where('role', 'user')->where('id', $id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:users,nik,'.$user->id,
            'name' => 'required',
            'gender' => 'required|in:L,P',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required|in:active,suspend'
        ]);

        if ($validator->fails()) {
            \Session::flash('edit_fails_id', $id);
            return redirect()->back()
                ->withErrors($validator, 'edit')
                ->withInput();
        }

        $datauser = $request->only('nik','name', 'gender', 'email', 'phone', 'address', 'status');

        if ($request->password != '') {
            $validator2 = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:8',
            ]);
            if ($validator2->fails()) {
                \Session::flash('edit_fails_id', $id);
                return redirect()->back()
                    ->withErrors($validator2, 'edit')
                    ->withInput();
            }

            $datauser['password'] = Hash::make($request->password);
        }

        $user->update($datauser);

        \Session::flash('notification', ['level' => 'success', 'message' => 'User telah diubah']);
        return redirect()->route('usermanagement.enduser.index');
    }

    public function destroy(Request $request, $id)
    {
        if (!Gate::allows('be_super_admin') && !Gate::allows('be_admin')) {
            abort(403, 'Unauthorized action');
        }
        $user = User::where('role', 'user')->where('id', $id)->firstOrFail();
        $userId = $user->id;
        $user->delete();
        PermohonanSurat::where('user_id', $userId)->delete();

        \Session::flash('notification', ['level' => 'success', 'message' => 'User telah dihapus']);
        return redirect()->route('usermanagement.enduser.index');
    }

    public function importUser(Request $request)
    {
        if (!Gate::allows('be_super_admin') && !Gate::allows('be_admin')) {
            abort(403, 'Unauthorized action');
        }

        $validator = Validator::make($request->all(), [
            'import_file' => 'required|mimes:xls,xlsx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'import')
                ->withInput();
        }

        $import = new ImportEndUser;
        Excel::import($import, request()->file('import_file'));

        \Session::flash('notification', ['level' => 'success', 'message' => 'Berhasil melakukan import '.$import->getRowCount().' user']);
        return redirect()->route('usermanagement.enduser.index');
    }
}
