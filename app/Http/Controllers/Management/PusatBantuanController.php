<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\WebConfig;
use Illuminate\Http\Request;

class PusatBantuanController extends Controller
{
    public function index()
    {
        $webfig = WebConfig::whereIn('key', ['whatsapp', 'email', 'telepon'])->get();
        return view('cms.admin.pusat-bantuan.index', compact('webfig'));
    }

    public function update(Request $request)
    {
        if ($request->has('whatsapp')) {
            $request->validate(['whatsapp' => 'required']);

            $wa = WebConfig::where('key', 'whatsapp')->first();
            if (!empty($wa)) {
                $wa->update(['value' => $request->whatsapp, 'publish' => ($request->publish_wa == '1' ? '1' : '0')]);
            }
        }

        if ($request->has('email')) {
            $request->validate(['email' => 'required']);

            $email = WebConfig::where('key', 'email')->first();
            if (!empty($email)) {
                $email->update(['value' => $request->email, 'publish' => ($request->publish_email == '1' ? '1' : '0')]);
            }
        }

        if ($request->has('telepon')) {
            $request->validate(['telepon' => 'required']);

            $telepon = WebConfig::where('key', 'telepon')->first();
            if (!empty($telepon)) {
                $telepon->update(['value' => $request->telepon, 'publish' => ($request->publish_tlp == '1' ? '1' : '0')]);
            }
        }

        \Session::flash('notification', ['level' => 'success', 'message' => 'Data pusat bantuan telah diupdate']);
        return redirect()->route('pusat-bantuan.index');
    }
}
