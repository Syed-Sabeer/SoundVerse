<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppLink;
use Illuminate\Http\Request;

class AdminAppLinkController extends Controller
{
    public function index()
    {
        $appLink = AppLink::first();
        return view('admin.cms.app-links.index', compact('appLink'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'play_store_link' => 'nullable|url|max:500',
            'app_store_link'  => 'nullable|url|max:500',
        ]);

        $appLink = AppLink::firstOrCreate([], []);
        $appLink->update([
            'play_store_link' => $request->input('play_store_link'),
            'app_store_link'  => $request->input('app_store_link'),
        ]);

        return redirect()->route('admin.app-links.index')->with('success', 'App links updated successfully.');
    }
}
