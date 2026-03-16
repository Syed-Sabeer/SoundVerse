<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminAboutController extends Controller
{
    public function index()
    {
        $aboutSection = AboutSection::first();
        return view('admin.cms.about.index', compact('aboutSection'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'about_heading' => 'nullable|string|max:255',
                'about_description_1' => 'nullable|string',
                'about_description_2' => 'nullable|string',
                'about_button_link' => 'nullable|string|max:255',
                'about_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'about_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $aboutSection = AboutSection::first();
            $data = [
                'about_heading' => $request->about_heading,
                'about_description_1' => $request->about_description_1,
                'about_description_2' => $request->about_description_2,
                'about_button_link' => $request->about_button_link,
            ];

            // Handle about_image_1
            if ($request->hasFile('about_image_1')) {
                // Delete old image if exists
                if ($aboutSection && $aboutSection->about_image_1) {
                    Storage::disk('public')->delete($aboutSection->about_image_1);
                }
                
                // Store new image
                $image1Path = $request->file('about_image_1')->store('uploads/about', 'public');
                $data['about_image_1'] = $image1Path;
            } elseif ($aboutSection && $aboutSection->about_image_1) {
                // Keep existing image if no new one uploaded
                $data['about_image_1'] = $aboutSection->about_image_1;
            }

            // Handle about_image_2
            if ($request->hasFile('about_image_2')) {
                // Delete old image if exists
                if ($aboutSection && $aboutSection->about_image_2) {
                    Storage::disk('public')->delete($aboutSection->about_image_2);
                }
                
                // Store new image
                $image2Path = $request->file('about_image_2')->store('uploads/about', 'public');
                $data['about_image_2'] = $image2Path;
            } elseif ($aboutSection && $aboutSection->about_image_2) {
                // Keep existing image if no new one uploaded
                $data['about_image_2'] = $aboutSection->about_image_2;
            }

            if (!$aboutSection) {
                // Create new record if none exists
                $aboutSection = AboutSection::create($data);
                Log::info('About section created successfully', ['id' => $aboutSection->id]);
            } else {
                // Update existing record
                $aboutSection->update($data);
                Log::info('About section updated successfully', ['id' => $aboutSection->id]);
            }

            return redirect()->route('admin.about.index')->with('success', 'About section updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('About section validation error:', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('About section update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
