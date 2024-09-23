<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Service\OtpCodeService;
use App\Models\Otp;
use App\Models\User;
use App\Notifications\ForgetPasswordOtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{
    public function requestOtp(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Email tidak ditemukan',
                'success' => false
            ], 404);
        }

        $user = User::where('role', 'user')->where('status', 'active')->where('email', $request->email)->first();
        if (empty($user)) {
            return response()->json([
                'message' => 'User tidak ditemukan/sedang di suspend',
                'success' => false
            ], 404);
        }

        $otpService = new OtpCodeService();
        $reqtoken = $otpService->requestOtp($request->email, $request->unique_id, $user);

        if ($reqtoken != '') {
            $user->notify(new ForgetPasswordOtpNotification($user, $reqtoken));

            return response()->json([
                'message' => 'Kode verifikasi telah dikirim melalui email',
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'Terjadi kesalahan pada server saat request kode',
                'success' => false
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $otpService = new OtpCodeService();
        $result = $otpService->verifyOtp($request->otp_code, $request->unique_id);
        return response()->json($result, 200);
    }

    public function setPassword(Request $request)
    {
        $rules = [
            'password' => 'required|confirmed|min:8'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Konfirmasi password tidak sesuai',
                'success' => false
            ], 200);
        }

        $savedOtp = Otp::where('unique_id', $request->unique_id)->where('is_revoked', '1')->orderBy('updated_at', 'desc')->first();
        if (!empty($savedOtp)) {
            $user = User::where('id', $savedOtp->user_id)->where('email', $savedOtp->email)->where('role', 'user')->where('status', 'active')->first();
            if (!empty($user)) {
                $user->update(['password' => Hash::make($request->password)]);
                return response()->json([
                    'message' => 'Reset password berhasil',
                    'success' => true
                ], 200);
            } else {
                return response()->json([
                    'message' => 'User tidak ditemukan',
                    'success' => false
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'Request tidak valid',
                'success' => false
            ], 400);
        }
    }
}
