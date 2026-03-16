<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceArtworkPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminServiceArtworkPhotoController extends Controller
{
    public function index()
    {
        $services = ServiceArtworkPhoto::all();
        return view('admin.services.artworkphoto.index', compact('services'));
    }

    public function add()
    {
        return view('admin.services.artworkphoto.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'icon' => 'required|string',
                'title' => 'required|string|max:255',
                'description' => 'required',
            ]);

            $service = ServiceArtworkPhoto::create([
                'icon' => $request->icon,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            Log::info('Artwork Photo Service created successfully.', ['id' => $service->id]);

            return redirect()->route('admin.service.artworkphoto.index')->with('success', 'Artwork Photo Service added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating artwork photo service:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $service = ServiceArtworkPhoto::findOrFail($id);
        return view('admin.services.artworkphoto.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'icon' => 'required|string',
                'title' => 'required|string|max:255',
                'description' => 'required',
            ]);

            $service = ServiceArtworkPhoto::findOrFail($id);
            $service->update([
                'icon' => $request->icon,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.service.artworkphoto.index')->with('success', 'Artwork Photo Service updated successfully.');
        } catch (\Exception $e) {
            Log::error('Artwork Photo Service update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $service = ServiceArtworkPhoto::findOrFail($id);
            $service->delete();
            return redirect()->route('admin.service.artworkphoto.index')->with('success', 'Artwork Photo Service deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Artwork Photo Service delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete artwork photo service.');
        }
    }
}

