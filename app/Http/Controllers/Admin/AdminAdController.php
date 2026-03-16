<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AdminAdController extends Controller
{
    public function index()
    {
        Log::info('AdminAdController: Loading ads index page');
        
        try {
            $ads = Ad::orderBy('created_at', 'desc')->paginate(10);
            Log::info('AdminAdController: Successfully loaded ' . $ads->count() . ' ads for index page');
            
            return view('admin.crud.ads.index', compact('ads'));
        } catch (\Exception $e) {
            Log::error('AdminAdController: Error loading ads index page', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Error loading ads: ' . $e->getMessage());
        }
    }

    public function create()
    {
        Log::info('AdminAdController: Loading create ad form');
        return view('admin.crud.ads.add');
    }

    public function store(Request $request)
    {
        Log::info('AdminAdController: Starting ad creation process', [
            'title' => $request->title,
            'has_file' => $request->hasFile('file'),
            'link' => $request->link,
            'visibility' => $request->has('visibility') ? 1 : 0
        ]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:300',
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,avi,mov|max:20480', // 10MB max
            'link' => 'required|url',
            'visibility' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            Log::warning('AdminAdController: Validation failed for ad creation', [
                'errors' => $validator->errors()->toArray(),
                'input' => $request->except(['file'])
            ]);
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $filePath = null;
            
            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('ads', $fileName, 'public');
                
                Log::info('AdminAdController: File uploaded successfully', [
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'stored_path' => $filePath
                ]);
            }

            $ad = Ad::create([
                'title' => $request->title,
                'file' => $filePath,
                'link' => $request->link,
                'visibility' => $request->has('visibility') ? 1 : 0
            ]);

            Log::info('AdminAdController: Ad created successfully', [
                'ad_id' => $ad->id,
                'title' => $ad->title,
                'file_path' => $ad->file,
                'link' => $ad->link,
                'visibility' => $ad->visibility
            ]);

            return redirect()->route('admin.ads.index')
                ->with('success', 'Ad created successfully!');

        } catch (\Exception $e) {
            Log::error('AdminAdController: Error creating ad', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->except(['file'])
            ]);
            
            return redirect()->back()
                ->with('error', 'Error creating ad: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        Log::info('AdminAdController: Loading edit form for ad', ['ad_id' => $id]);
        
        try {
            $ad = Ad::findOrFail($id);
            Log::info('AdminAdController: Successfully loaded ad for editing', [
                'ad_id' => $ad->id,
                'title' => $ad->title,
                'has_file' => !is_null($ad->file),
                'visibility' => $ad->visibility
            ]);
            
            return view('admin.crud.ads.edit', compact('ad'));
        } catch (\Exception $e) {
            Log::error('AdminAdController: Error loading ad for editing', [
                'ad_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('admin.ads.index')
                ->with('error', 'Ad not found or error loading ad: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('AdminAdController: Starting ad update process', [
            'ad_id' => $id,
            'title' => $request->title,
            'has_file' => $request->hasFile('file'),
            'link' => $request->link,
            'visibility' => $request->has('visibility') ? 1 : 0
        ]);

        try {
            $ad = Ad::findOrFail($id);
            
            Log::info('AdminAdController: Found ad for update', [
                'ad_id' => $ad->id,
                'current_title' => $ad->title,
                'current_file' => $ad->file,
                'current_visibility' => $ad->visibility
            ]);

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:300',
                'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,avi,mov|max:20480',
                'link' => 'required|url',
                'visibility' => 'nullable|boolean'
            ]);

            if ($validator->fails()) {
                Log::warning('AdminAdController: Validation failed for ad update', [
                    'ad_id' => $id,
                    'errors' => $validator->errors()->toArray(),
                    'input' => $request->except(['file'])
                ]);
                
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = [
                'title' => $request->title,
                'link' => $request->link,
                'visibility' => $request->has('visibility') ? 1 : 0
            ];

            // Handle file upload if new file is provided
            if ($request->hasFile('file')) {
                Log::info('AdminAdController: New file provided for update', [
                    'ad_id' => $id,
                    'current_file' => $ad->file
                ]);
                
                // Delete old file
                if ($ad->file && Storage::disk('public')->exists($ad->file)) {
                    Storage::disk('public')->delete($ad->file);
                    Log::info('AdminAdController: Old file deleted', ['old_file' => $ad->file]);
                }

                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('ads', $fileName, 'public');
                $data['file'] = $filePath;
                
                Log::info('AdminAdController: New file uploaded successfully', [
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'stored_path' => $filePath
                ]);
            } else {
                Log::info('AdminAdController: No new file provided, keeping existing file', [
                    'ad_id' => $id,
                    'existing_file' => $ad->file
                ]);
            }

            $ad->update($data);

            Log::info('AdminAdController: Ad updated successfully', [
                'ad_id' => $ad->id,
                'updated_title' => $ad->title,
                'updated_file' => $ad->file,
                'updated_link' => $ad->link,
                'updated_visibility' => $ad->visibility
            ]);

            return redirect()->route('admin.ads.index')
                ->with('success', 'Ad updated successfully!');

        } catch (\Exception $e) {
            Log::error('AdminAdController: Error updating ad', [
                'ad_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->except(['file'])
            ]);
            
            return redirect()->back()
                ->with('error', 'Error updating ad: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        Log::info('AdminAdController: Starting ad deletion process', ['ad_id' => $id]);
        
        try {
            $ad = Ad::findOrFail($id);
            
            Log::info('AdminAdController: Found ad for deletion', [
                'ad_id' => $ad->id,
                'title' => $ad->title,
                'file' => $ad->file,
                'visibility' => $ad->visibility
            ]);

            // Delete file from storage
            if ($ad->file && Storage::disk('public')->exists($ad->file)) {
                Storage::disk('public')->delete($ad->file);
                Log::info('AdminAdController: File deleted from storage', ['file_path' => $ad->file]);
            } else {
                Log::info('AdminAdController: No file to delete or file not found', ['file_path' => $ad->file]);
            }

            $ad->delete();

            Log::info('AdminAdController: Ad deleted successfully', [
                'ad_id' => $id,
                'title' => $ad->title
            ]);

            return redirect()->route('admin.ads.index')
                ->with('success', 'Ad deleted successfully!');

        } catch (\Exception $e) {
            Log::error('AdminAdController: Error deleting ad', [
                'ad_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Error deleting ad: ' . $e->getMessage());
        }
    }

    public function toggleVisibility(Request $request, $id)
    {
        Log::info('AdminAdController: Starting visibility toggle process', ['ad_id' => $id]);
        
        try {
            $ad = Ad::findOrFail($id);
            
            $oldVisibility = $ad->visibility;
            
            Log::info('AdminAdController: Toggling ad visibility', [
                'ad_id' => $ad->id,
                'title' => $ad->title,
                'old_visibility' => $oldVisibility
            ]);
            
            // Toggle the visibility: if it's 1, make it 0; if it's 0, make it 1
            $ad->visibility = $ad->visibility ? 0 : 1;
            $ad->save();
            
            Log::info('AdminAdController: Ad visibility toggled successfully', [
                'ad_id' => $ad->id,
                'title' => $ad->title,
                'new_visibility' => $ad->visibility
            ]);
            
            return redirect()->route('admin.ads.index')
                ->with('success', 'Ad visibility updated successfully.');

        } catch (\Exception $e) {
            Log::error('AdminAdController: Error toggling ad visibility', [
                'ad_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Could not update ad visibility.');
        }
    }
}
