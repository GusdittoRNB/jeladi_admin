<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAdminController extends Controller
{
    public function index() {
        $users = User::whereIn('role', ['admin', 'super_admin'])->get();
        return view('cms.admin.usermanagement.adminuser.index', compact('users'));
    }

    public function store(Request $request) {
        if (!Gate::allows('be_super_admin')) {
            abort(403, 'Unauthorized action');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed|min:8',
            'status' => 'required|in:active,suspend',
            'role' => 'required|in:admin,super_admin'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'add')
                ->withInput();
        }

        $datauser = $request->only('name', 'email', 'phone', 'address', 'status', 'role');
        $datauser['password'] = Hash::make($request->password);
        $user = User::create($datauser);

        \Session::flash('notification', ['level' => 'success', 'message' => 'User admin telah ditambahkan']);
        return redirect()->route('usermanagement.admin.index');
    }

    public function edit($id)
    {
        $user = User::whereIn('role', ['admin', 'super_admin'])->where('id', $id)->firstOrFail();
        return view('cms.admin.usermanagement.adminuser._edit', compact('user'))->render();
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('be_super_admin')) {
            abort(403, 'Unauthorized action');
        }
        $user = User::whereIn('role', ['admin', 'super_admin'])->where('id', $id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required|in:active,suspend',
            'role' => 'required|in:admin,super_admin'
        ]);

        if ($validator->fails()) {
            \Session::flash('edit_fails_id', $id);
            return redirect()->back()
                ->withErrors($validator, 'edit')
                ->withInput();
        }

        $datauser = $request->only('name', 'email', 'phone', 'address', 'status', 'role');

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

        \Session::flash('notification', ['level' => 'success', 'message' => 'User admin telah diubah']);
        return redirect()->route('usermanagement.admin.index');
    }

    public function destroy(Request $request, $id)
    {
        if (!Gate::allows('be_super_admin')) {
            abort(403, 'Unauthorized action');
        }
        $user = User::whereIn('role', ['admin', 'super_admin'])->where('id', $id)->firstOrFail();

        $user->delete();

        \Session::flash('notification', ['level' => 'success', 'message' => 'User admin telah dihapus']);
        return redirect()->route('usermanagement.admin.index');
    }
}
