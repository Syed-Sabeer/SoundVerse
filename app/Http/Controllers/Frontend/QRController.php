<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppLink;
use Illuminate\Http\Request;

class QRController extends Controller
{
    public function download(Request $request)
    {
        $userAgent = $request->header('User-Agent');

        $appLink = AppLink::first();

        $androidLink = $appLink->play_store_link ?? 'https://play.google.com/store';
        $iosLink     = $appLink->app_store_link  ?? 'https://apps.apple.com';

        if (preg_match('/android/i', $userAgent)) {
            return redirect()->away($androidLink);
        }

        if (preg_match('/iphone|ipad|ipod/i', $userAgent)) {
            return redirect()->away($iosLink);
        }

        // fallback (desktop etc) – send to Play Store
        return redirect()->away($androidLink);
    }
}
