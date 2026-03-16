<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('admin.crud.partners.index', compact('partners'));
    }

    public function add()
    {
        return view('admin.crud.partners.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'visibility' => 'nullable|integer',
            ]);

            $validatedData = $request->only(['title', 'logo', 'visibility']);

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoName = time() . '_' . $logo->getClientOriginalName();
                $logoPath = $logo->storeAs('uploads', $logoName, 'public');
                $validatedData['logo'] = $logoPath;
            }

            Log::info('Validated Partner data:', $validatedData);

            $partner = Partner::create([
                'title' => $validatedData['title'],
                'logo' => $validatedData['logo'] ?? null,
                'visibility' => $validatedData['visibility'] ?? 1,
            ]);

            Log::info('Partner created successfully:', ['id' => $partner->id]);

            return redirect()->route('admin.partner.index')->with('success', 'Partner added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating partner:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.crud.partners.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'visibility' => 'nullable|integer',
            ]);

            $partner = Partner::findOrFail($id);
            $updateData = [
                'title' => $request->title,
                'visibility' => $request->visibility ?? 1,
            ];

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                    Storage::disk('public')->delete($partner->logo);
                }

                $logo = $request->file('logo');
                $logoName = time() . '_' . $logo->getClientOriginalName();
                $logoPath = $logo->storeAs('uploads', $logoName, 'public');
                $updateData['logo'] = $logoPath;
            }

            $partner->update($updateData);

            return redirect()->route('admin.partner.index')->with('success', 'Partner updated successfully.');
        } catch (\Exception $e) {
            Log::error('Partner update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $partner = Partner::findOrFail($id);

            // Delete logo if exists
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }

            $partner->delete();
            return redirect()->route('admin.partner.index')->with('success', 'Partner deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Partner delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete partner.');
        }
    }

    public function toggleVisibility(Request $request, $id)
    {
        try {
            $partner = Partner::findOrFail($id);
            // Toggle the visibility: if it's 1, make it 0; if it's 0, make it 1
            $partner->visibility = $partner->visibility ? 0 : 1;
            $partner->save();
            
            return redirect()->route('admin.partner.index')->with('success', 'Partner visibility updated successfully.');
        } catch (\Exception $e) {
            Log::error('Partner visibility toggle error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not update partner visibility.');
        }
    }
}
