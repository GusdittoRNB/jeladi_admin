<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Service\UserProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function detail()
    {
        return response()->json([
            'user' => Auth::user()->only('id', 'nik', 'name', 'gender', 'email', 'phone', 'address', 'user_profile', 'status'),
            'success' => true
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'nik' => 'required|unique:users,nik,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'profile_picture' => 'mimes:jpeg,png'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
                'success' => false
            ], 200);
        }

        $datauser = $request->only('nik','name', 'gender', 'email', 'phone', 'address');

        if ($request->hasFile('profile_picture')) {
            $userProfileService = new UserProfileService();
            $datauser['profile_picture'] = $userProfileService->saveImageProfile($request->file('profile_picture'), $request->name);
            if ('' !== $user->profile_picture) {
                $userProfileService->deleteImageProfile($user->profile_picture);
            }
        }

        $user->update($datauser);

        return response()->json([
            'user' => $user->only('id', 'nik', 'name', 'gender', 'email', 'phone', 'address', 'user_profile', 'status'),
            'message' => 'Profile telah diupdate',
            'success' => true
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'current_password' => 'required|current_password|min:8',
            'password' => 'required|confirmed|min:8'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
                'success' => false
            ], 200);
        }

        $user = Auth::user();
        $user->update(['password' => Hash::make($request->password)]);

        return response()->json([
            'message' => 'Password telah diupdate',
            'success' => true
        ], 200);
    }
}
