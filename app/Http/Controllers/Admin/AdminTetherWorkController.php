<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TetherWork;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTetherWorkController extends Controller
{
    public function index()
    {
        $tetherWorks = TetherWork::all();
        return view('admin.crud.tether-works.index', compact('tetherWorks'));
    }

    public function add()
    {
        return view('admin.crud.tether-works.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
                'button_text' => 'nullable|string|max:255',
                'windows_link' => 'nullable|url|max:255',
                'apple_link' => 'nullable|url|max:255',
                'android_link' => 'nullable|url|max:255',
                'text' => 'nullable|string|max:255',
            ]);

            $validatedData = $request->only(['button_text', 'windows_link', 'apple_link', 'android_link', 'text']);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('uploads', $imageName, 'public');
                $validatedData['image'] = $imagePath;
            }

            Log::info('Validated TetherWork data:', $validatedData);

            $tetherWork = TetherWork::create($validatedData);

            Log::info('TetherWork created successfully:', ['id' => $tetherWork->id]);

            return redirect()->route('admin.tether-work.index')->with('success', 'Tether Work added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating tether work:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $tetherWork = TetherWork::findOrFail($id);
        return view('admin.crud.tether-works.edit', compact('tetherWork'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
                'button_text' => 'nullable|string|max:255',
                'windows_link' => 'nullable|url|max:255',
                'apple_link' => 'nullable|url|max:255',
                'android_link' => 'nullable|url|max:255',
                'text' => 'nullable|string|max:255',
            ]);

            $tetherWork = TetherWork::findOrFail($id);
            $updateData = [
                'button_text' => $request->button_text,
                'windows_link' => $request->windows_link,
                'apple_link' => $request->apple_link,
                'android_link' => $request->android_link,
                'text' => $request->text,
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($tetherWork->image && Storage::disk('public')->exists($tetherWork->image)) {
                    Storage::disk('public')->delete($tetherWork->image);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('uploads', $imageName, 'public');
                $updateData['image'] = $imagePath;
            }

            $tetherWork->update($updateData);

            return redirect()->route('admin.tether-work.index')->with('success', 'Tether Work updated successfully.');
        } catch (\Exception $e) {
            Log::error('TetherWork update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $tetherWork = TetherWork::findOrFail($id);

            // Delete image if exists
            if ($tetherWork->image && Storage::disk('public')->exists($tetherWork->image)) {
                Storage::disk('public')->delete($tetherWork->image);
            }

            $tetherWork->delete();
            return redirect()->route('admin.tether-work.index')->with('success', 'Tether Work deleted successfully.');
        } catch (\Exception $e) {
            Log::error('TetherWork delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete tether work.');
        }
    }
}
