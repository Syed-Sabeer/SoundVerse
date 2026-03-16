<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminWebsiteController extends Controller
{

  
    public function index()
    {
        $hero = \App\Models\HomeHeroSection::first();
 

        return view('admin.cms.home.index', compact(
            'hero'
        ));
    }

    public function royaltycms()
    {
        $aboutSection = \App\Models\CmsRoyaltyCollection::first();
        return view('admin.cms.royaltycollection.index', compact('aboutSection'));
    }

    
    public function updateAllSections(\Illuminate\Http\Request $request)
    {
        try {
            // Validate hero section data
            $request->validate([
                'heading' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'button_link' => 'nullable|string',
                'song_name' => 'nullable|string',
                'song_album' => 'nullable|string|max:255',
                'bg_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'song_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'song' => 'nullable|file|mimes:mp3,wav,ogg|max:10240',
                'pc_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'pc_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'pc_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'pc_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Hero Section
            $hero = \App\Models\HomeHeroSection::first();
            
            $heroData = [
                'heading' => $request->input('heading') ?: '',
                'description' => $request->input('description') ?: '',
                'button_link' => $request->input('button_link') ?: '',
                'song_name' => $request->input('song_name') ?: '',
                'song_album' => $request->input('song_album') ?: '',
            ];

            // Handle background image
            if ($request->hasFile('bg_image')) {
                $image = $request->file('bg_image');
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $heroData['bg_image'] = 'uploads/' . $imageName;
            }

            // Handle song image
            if ($request->hasFile('song_image')) {
                $image = $request->file('song_image');
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $heroData['song_image'] = 'uploads/' . $imageName;
            }

            // Handle song file
            if ($request->hasFile('song')) {
                $songFile = $request->file('song');
                $songName = time().'_'.$songFile->getClientOriginalName();
                $songFile->move(public_path('uploads/audio'), $songName);
                $heroData['song'] = 'uploads/audio/' . $songName;
            }

            // Handle popular corner images
            if ($request->hasFile('pc_image_1')) {
                $image = $request->file('pc_image_1');
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $heroData['pc_image_1'] = 'uploads/' . $imageName;
            }
            if ($request->hasFile('pc_image_2')) {
                $image = $request->file('pc_image_2');
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $heroData['pc_image_2'] = 'uploads/' . $imageName;
            }
            if ($request->hasFile('pc_image_3')) {
                $image = $request->file('pc_image_3');
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $heroData['pc_image_3'] = 'uploads/' . $imageName;
            }
            if ($request->hasFile('pc_image_4')) {
                $image = $request->file('pc_image_4');
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $heroData['pc_image_4'] = 'uploads/' . $imageName;
            }

            if (!$hero) {
                // Only create if there's actual data
                $hero = \App\Models\HomeHeroSection::create($heroData);
            } else {
                $hero->update($heroData);
            }
            \Log::info('Hero section updated successfully', ['hero_id' => $hero->id, 'data' => $heroData]);
        } catch (\Exception $e) {
            \Log::error('Error updating hero section', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            throw $e;
        }

       
    }

    public function updateRoyaltyCms(\Illuminate\Http\Request $request)
    {
        try {
            // Validate royalty collection data
            $request->validate([
                'title' => 'nullable|string|max:255',
                'value' => 'nullable|string|max:255',
                'title2' => 'nullable|string|max:255',
                'value2' => 'nullable|string|max:255',
                'title3' => 'nullable|string|max:255',
                'value3' => 'nullable|string|max:255',
                'title4' => 'nullable|string|max:255',
                'value4' => 'nullable|string|max:255',
            ]);

            // Royalty Collection Section
            $royalty = \App\Models\CmsRoyaltyCollection::first();
            
            $royaltyData = [
                'title' => $request->input('title') ?: '',
                'value' => $request->input('value') ?: '',
                'title2' => $request->input('title2') ?: '',
                'value2' => $request->input('value2') ?: '',
                'title3' => $request->input('title3') ?: '',
                'value3' => $request->input('value3') ?: '',
                'title4' => $request->input('title4') ?: '',
                'value4' => $request->input('value4') ?: '',
            ];

            if (!$royalty) {
                // Create new record if none exists
                $royalty = \App\Models\CmsRoyaltyCollection::create($royaltyData);
            } else {
                // Update existing record
                $royalty->update($royaltyData);
            }

            \Log::info('Royalty collection section updated successfully', ['royalty_id' => $royalty->id, 'data' => $royaltyData]);

            return redirect()->route('admin.royalty.cms')->with('success', 'Royalty Collection section updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Error updating royalty collection section', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the royalty collection section. Please try again.'])->withInput();
        }
    }
}
