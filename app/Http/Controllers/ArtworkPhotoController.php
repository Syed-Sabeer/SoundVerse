<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtworkPhoto;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArtworkPhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'file|mimes:jpeg,jpg,png,gif,webp,avif|max:10240', 
        ]);

        $uploadedImages = [];

        foreach ($request->file('images') as $image) {
            $imageName = 'artwork_' . time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('artwork_photos', $imageName, 'public');

            $artworkPhoto = ArtworkPhoto::create([
                'driver_id' => Auth::id(),
                'image' => $imagePath,
            ]);

            $uploadedImages[] = $artworkPhoto;
        }

        // Notify subscribers that this artist uploaded new artwork
        try {
            $artist = Auth::user();
            if ($artist && method_exists($artist, 'followerUsers')) {
                $subscribers = $artist->followerUsers()->get();
                if ($subscribers->isNotEmpty()) {
                    $message = ($artist->name ?? $artist->username ?? 'An artist') .
                        ' uploaded new artwork.';
                    app('notificationService')->notifyUsers($subscribers, $message, 'New Artwork Uploaded', 'system');
                }
            }
        } catch (\Throwable $e) {
            // Ignore notification failures
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Artwork uploaded successfully!',
                'data' => $uploadedImages
            ]);
        }

        return redirect()->back()->with('success', 'Artwork uploaded successfully!');
    }

    public function index()
    {
        $artworkPhotos = ArtworkPhoto::where('driver_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.artist.my-artwork', compact('artworkPhotos'));
    }

    public function destroy($id)
    {
        $artworkPhoto = ArtworkPhoto::where('driver_id', Auth::id())->findOrFail($id);

        if ($artworkPhoto->image && Storage::disk('public')->exists($artworkPhoto->image)) {
            Storage::disk('public')->delete($artworkPhoto->image);
        }

        $artworkPhoto->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Artwork deleted successfully!'
            ]);
        }

        return redirect()->back()->with('success', 'Artwork deleted successfully!');
    }
}