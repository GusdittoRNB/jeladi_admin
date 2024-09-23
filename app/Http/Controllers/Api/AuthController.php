<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required|min:8'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
                'success' => false
            ], 200);
        }

        $login_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL ) ? 'email' : 'nik';
        if (Auth::attempt([$login_type => $request->email, 'password' => $request->password, 'role' => 'user']))
        {
            if (Auth::user()->status == 'suspend') {
                Auth::logout();

                return response()->json([
                    'message' => 'User sedang di suspend, silakan menghubungi admin!',
                    'success' => false
                ], 401);
            }

            $token = Auth::user()->createToken('Passport Access Token')->accessToken;

            return response()->json([
                'user' => Auth::user()->only('id', 'nik', 'name', 'gender', 'email', 'phone', 'address', 'user_profile', 'status'),
                'token' => $token,
                'message' => 'Login sukses',
                'success' => true
            ], 200);
        }

        return response()->json([
            'message' => 'Maaf email dan password tidak sesuai dengan database kami',
            'success' => false
        ], 401);

    }

    public function logout(Request $request) {
        $user = Auth::user()->token();
        $result = $user->revoke();
        if ($result) {
            return response()->json([
                'message' => 'User berhasil logout',
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'Something is wrong.',
                'success' => false
            ], 500);
        }
    }
}
