<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsRoyaltyCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminServiceCmsController extends Controller
{
    public function index()
    {
        $aboutSection = CmsRoyaltyCollection::first();
        return view('admin.cms.royaltycollection.index', compact('aboutSection'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'title' => 'nullable|string|max:255',
                'about_description_1' => 'nullable|string',
                'value' => 'nullable|string',
            ]);

            $aboutSection = CmsRoyaltyCollection::first();
            $data = [
                'title' => $request->title,
                'value' => $request->value,
            ];

         
            $aboutSection = AboutSection::first();
                $data = [
                    'about_heading' => $request->about_heading,
                    'about_description_1' => $request->about_description_1,
                    'about_description_2' => $request->about_description_2,
                    'about_button_link' => $request->about_button_link,
                ];

      

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
