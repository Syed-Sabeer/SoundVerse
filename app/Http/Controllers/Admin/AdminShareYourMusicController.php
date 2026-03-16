<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialShareMusic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminShareYourMusicController extends Controller
{

    public function index()
    {
        Log::info('Admin accessing social share music index');
        $socialShareMusic = SocialShareMusic::all();
        Log::info('Retrieved ' . $socialShareMusic->count() . ' social share music records');
        return view('admin.crud.social-share-music.index', compact('socialShareMusic'));
    }

    public function cmsindex(){
        $shareyourmusic = \App\Models\ShareYourMusicSection::first();
        return view('admin.cms.shareyourmusic.index', compact('shareyourmusic'));
    }
    public function cmsupdate(Request $request)
    {
        $shareyourmusic = \App\Models\ShareYourMusicSection::first();
    
        if (!$shareyourmusic) {
            $shareyourmusic = new \App\Models\ShareYourMusicSection();
        }
    
        $shareyourmusic->fill($request->all());
        $shareyourmusic->save();
    
        return redirect()->route('admin.cms.shareyourmusic.index')
                         ->with('success', 'Share Your Music updated successfully.');
    }
    
    public function add()
    {
        Log::info('Admin accessing social share music add form');
        return view('admin.crud.social-share-music.add');
    }

    public function store(Request $request){
        Log::info('Admin attempting to store social share music', ['request_data' => $request->except(['image'])]);
        
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'link' => 'required|url|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            Log::info('Validation passed for social share music store');

            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = time().'_'.$image->getClientOriginalName();
                $imagePath = $image->storeAs('uploads', $imageName, 'public');
                $validatedData['image'] = $imagePath;
                Log::info('Image uploaded successfully', ['image_path' => $imagePath]);
            }

            // Create with default visibility of 1 (visible)
            $socialShareMusic = SocialShareMusic::create([
                'title' => $validatedData['title'],
                'link' => $validatedData['link'],
                'image' => $validatedData['image'],
                'visibility' => 1, // Default to visible
            ]);

            Log::info('Social share music created successfully', ['id' => $socialShareMusic->id, 'title' => $socialShareMusic->title]);
            
            return redirect()->route('admin.social-share-music.index')->with('success', 'Social Share Music added successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing social share music', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['image'])
            ]);
            return redirect()->back()->with('error', 'Failed to add Social Share Music. Please try again.')->withInput();
        }
    }

    public function edit($id)
    {
        Log::info('Admin accessing social share music edit form', ['id' => $id]);
        try {
            $socialShareMusic = SocialShareMusic::findOrFail($id);
            Log::info('Social share music found for editing', ['id' => $id, 'title' => $socialShareMusic->title]);
            return view('admin.crud.social-share-music.edit', compact('socialShareMusic'));
        } catch (\Exception $e) {
            Log::error('Error finding social share music for edit', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('admin.social-share-music.index')->with('error', 'Social Share Music not found.');
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('Admin attempting to update social share music', ['id' => $id, 'request_data' => $request->except(['image'])]);
        
        try {
            $socialShareMusic = SocialShareMusic::findOrFail($id);
            Log::info('Found social share music for update', ['id' => $id, 'current_title' => $socialShareMusic->title]);

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'link' => 'required|url|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            Log::info('Validation passed for social share music update');

            // Handle image upload if new image is provided
            if($request->hasFile('image')){
                // Delete old image if exists
                if($socialShareMusic->image && Storage::disk('public')->exists($socialShareMusic->image)) {
                    Storage::disk('public')->delete($socialShareMusic->image);
                    Log::info('Old image deleted', ['old_image_path' => $socialShareMusic->image]);
                }
                
                $image = $request->file('image');
                $imageName = time().'_'.$image->getClientOriginalName();
                $imagePath = $image->storeAs('uploads', $imageName, 'public');
                $validatedData['image'] = $imagePath;
                Log::info('New image uploaded', ['new_image_path' => $imagePath]);
            }

            $socialShareMusic->update($validatedData);
            Log::info('Social share music updated successfully', [
                'id' => $socialShareMusic->id, 
                'title' => $socialShareMusic->title,
                'updated_data' => $validatedData
            ]);

            return redirect()->route('admin.social-share-music.index')->with('success', 'Social Share Music updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating social share music', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['image'])
            ]);
            return redirect()->back()->with('error', 'Failed to update Social Share Music. Please try again.')->withInput();
        }
    }

    public function destroy($id)
    {
        Log::info('Admin attempting to delete social share music', ['id' => $id]);
        
        try {
            $socialShareMusic = SocialShareMusic::findOrFail($id);
            Log::info('Found social share music for deletion', ['id' => $id, 'title' => $socialShareMusic->title]);

            // Delete associated image if exists
            if($socialShareMusic->image && Storage::disk('public')->exists($socialShareMusic->image)) {
                Storage::disk('public')->delete($socialShareMusic->image);
                Log::info('Associated image deleted', ['image_path' => $socialShareMusic->image]);
            }

            $socialShareMusic->delete();
            Log::info('Social share music deleted successfully', ['id' => $id, 'title' => $socialShareMusic->title]);
            
            return redirect()->route('admin.social-share-music.index')->with('success', 'Social Share Music deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting social share music', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to delete Social Share Music. Please try again.');
        }
    }

    public function toggleVisibility(Request $request, $id)
    {
        Log::info('Admin attempting to toggle social share music visibility', ['id' => $id]);
        
        try {
            $socialShareMusic = SocialShareMusic::findOrFail($id);
            Log::info('Found social share music for visibility toggle', ['id' => $id, 'title' => $socialShareMusic->title]);
            
            // Toggle the visibility: if it's 1, make it 0; if it's 0, make it 1
            $socialShareMusic->visibility = $socialShareMusic->visibility ? 0 : 1;
            $socialShareMusic->save();
            
            Log::info('Social share music visibility toggled successfully', [
                'id' => $id, 
                'title' => $socialShareMusic->title,
                'new_visibility' => $socialShareMusic->visibility
            ]);
            
            return redirect()->route('admin.social-share-music.index')->with('success', 'Social Share Music visibility updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error toggling social share music visibility', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Could not update social share music visibility.');
        }
    }
}
