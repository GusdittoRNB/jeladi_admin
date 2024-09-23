<?php

namespace App\Http\Service;

use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;

class OtpCodeService
{
    public function requestOtp($email, $unique_id, $user)
    {
        $kodeotp = '';

        $now = Carbon::now();
        $savedOtp = Otp::where('email', $user->email)->where('user_id', $user->id)->where('unique_id', $unique_id)->where('is_revoked', null)->where('expired_at', '>', $now)->orderBy('created_at', 'desc')->first();
        if(!empty($savedOtp)) {
            $kodeotp = $savedOtp->otp_code;
        } else {
            $kodeotp = $this->generateOtpCode();

            $dtSaveOtp = [
                'email' => $user->email,
                'otp_code' => $kodeotp,
                'unique_id' => $unique_id,
                'expired_at' => Carbon::now()->addMinute(10),
                'user_id' => $user->id,
            ];
            Otp::create($dtSaveOtp);
        }

        return $kodeotp;
    }

    public function verifyOtp($otp_code, $unique_id)
    {
        $now = Carbon::now();
        $savedOtp = Otp::where('unique_id', $unique_id)->where('is_revoked', null)->where('expired_at', '>', $now)->orderBy('created_at', 'desc')->first();
        if(!empty($savedOtp)) {
            if ($savedOtp->otp_code == $otp_code) {
                $savedOtp->update(['is_revoked' => '1']);
                $result = [
                    'message' => 'Verifikasi kode OTP berhasil',
                    'success' => true
                ];
            } else {
                $result = [
                    'message' => 'Kode OTP salah',
                    'success' => false
                ];
            }
        } else {
            $result = [
                'message' => 'Kode OTP tidak ditemukan/sudah expired',
                'success' => false
            ];
        }

        return $result;
    }

    protected function generateOtpCode()
    {
        $kode = rand(1000,9999);
        return $kode;
    }
}
