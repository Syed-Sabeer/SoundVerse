<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveVideo;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminLiveVideoController extends Controller
{
    public function index()
    {
        $liveVideos = LiveVideo::all();
        return view('admin.crud.live-video.index', compact('liveVideos'));
    }

    public function add()
    {
        return view('admin.crud.live-video.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'video' => 'required',
                'views' => 'required',
                'visibility' => 'nullable|integer',
            ]);

            $validatedData = $request->only(['title', 'video', 'views', 'visibility']);

            // Handle image upload
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $videoPath = $video->storeAs('uploads', $videoName, 'public');
                $validatedData['video'] = $videoPath;
            }

            Log::info('Validated LiveVideo data:', $validatedData);

            $liveVideo = LiveVideo::create([
                'title' => $validatedData['title'],
                'video' => $validatedData['video'] ?? null,
                'views' => $validatedData['views'] ?? null,
                'visibility' => $validatedData['visibility'] ?? 1,
            ]);

                Log::info('LiveVideo created successfully:', ['id' => $liveVideo->id]);

            return redirect()->route('admin.live-video.index')->with('success', 'LiveVideo added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating live video:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $liveVideo = LiveVideo::findOrFail($id);
        return view('admin.crud.live-video.edit', compact('liveVideo'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'video' => 'required',
                'views' => 'required',
                'visibility' => 'nullable|integer',
            ]);

            $liveVideo = LiveVideo::findOrFail($id);
            $updateData = [
                'title' => $request->title,
                'video' => $request->video ?? null,
                'views' => $request->views ?? null,
                'visibility' => $request->visibility ?? 1,
            ];

            // Handle image upload
            if ($request->hasFile('video')) {
                // Delete old image if exists
                if ($liveVideo->video && Storage::disk('public')->exists($liveVideo->video)) {
                    Storage::disk('public')->delete($liveVideo->video);
                }

                $video = $request->file('video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $videoPath = $video->storeAs('uploads', $videoName, 'public');
                $updateData['video'] = $videoPath;
            }

            $liveVideo->update($updateData);

            return redirect()->route('admin.live-video.index')->with('success', 'LiveVideo updated successfully.');
        } catch (\Exception $e) {
            Log::error('LiveVideo update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $liveVideo = LiveVideo::findOrFail($id);

            // Delete image if exists
            if ($liveVideo->video && Storage::disk('public')->exists($liveVideo->video)) {
                Storage::disk('public')->delete($liveVideo->video);
            }

            $liveVideo->delete();
            return redirect()->route('admin.live-video.index')->with('success', 'LiveVideo deleted successfully.');
        } catch (\Exception $e) {
            Log::error('LiveVideo delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete live video.');
        }
    }

    public function toggleVisibility(Request $request, $id)
    {
        try {
            $liveVideo = LiveVideo::findOrFail($id);
            // Toggle the visibility: if it's 1, make it 0; if it's 0, make it 1
            $liveVideo->visibility = $liveVideo->visibility ? 0 : 1;
            $liveVideo->save();
            
            return redirect()->route('admin.live-video.index')->with('success', 'LiveVideo visibility updated successfully.');
        } catch (\Exception $e) {
            Log::error('LiveVideo visibility toggle error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not update live video visibility.');
        }
    }
}
