<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceMusicVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminServiceMusicVideoController extends Controller
{
    public function index()
    {
        $services = ServiceMusicVideo::all();
        return view('admin.services.musicvideoupload.index', compact('services'));
    }

    public function add()
    {
        return view('admin.services.musicvideoupload.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'icon' => 'required|string',
                'description' => 'required',
                'button_link' => 'required|string',
                'include' => 'required|array|min:1',
                'include.*' => 'required|string'
            ]);

            $service = ServiceMusicVideo::create([
                'title' => $request->title,
                'icon' => $request->icon,
                'description' => $request->description,
                'button_link' => $request->button_link,
                'include' => json_encode($request->include),
            ]);

            Log::info('Music Video Service created successfully.', ['id' => $service->id]);

            return redirect()->route('admin.service.musicvideo.index')->with('success', 'Music Video Service added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating music video service:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $service = ServiceMusicVideo::findOrFail($id);
        return view('admin.services.musicvideoupload.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'icon' => 'required|string',
                'description' => 'required',
                'button_link' => 'required|string',
                'include' => 'required|array|min:1',
                'include.*' => 'required|string'
            ]);

            $service = ServiceMusicVideo::findOrFail($id);
            $service->update([
                'title' => $request->title,
                'icon' => $request->icon,
                'description' => $request->description,
                'button_link' => $request->button_link,
                'include' => json_encode($request->include),
            ]);

            return redirect()->route('admin.service.musicvideo.index')->with('success', 'Music Video Service updated successfully.');
        } catch (\Exception $e) {
            Log::error('Music Video Service update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $service = ServiceMusicVideo::findOrFail($id);
            $service->delete();
            return redirect()->route('admin.service.musicvideo.index')->with('success', 'Music Video Service deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Music Video Service delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete music video service.');
        }
    }
}
