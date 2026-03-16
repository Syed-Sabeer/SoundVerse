<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RingPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminRingController extends Controller
{
    public function index()
    {
        $rings = RingPackage::all();
        return view('admin.rings.index', compact('rings'));
    }

    public function add()
    {
        return view('admin.rings.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'package_name' => 'required|string|max:255',
               
                'sub_package_name' => 'required|array|min:1',
                'sub_package_name.*' => 'required|string|max:255',
                  'sub_package_price' => 'required|array|min:1',
                'sub_package_price.*' => 'required|string|max:255',
                  'sub_package_subtitle' => 'required|array|min:1',
                'sub_package_subtitle.*' => 'required|string|max:255',
                  'sub_package_couples' => 'required|array|min:1',
                'sub_package_couples.*' => 'required|string|max:255',
                'sub_package_rings' => 'required|array|min:1',
                'sub_package_rings.*' => 'required|string|max:255'
            ]);

            $ring = RingPackage::create([
                'package_name' => $request->package_name,
                'sub_package_name' => json_encode($request->sub_package_name),
                'sub_package_price' => json_encode($request->sub_package_price),
                'sub_package_subtitle' => json_encode($request->sub_package_subtitle),
                'sub_package_couples' => json_encode($request->sub_package_couples),
                'sub_package_rings' => json_encode($request->sub_package_rings),
            ]);

            Log::info('ring created successfully.', ['id' => $ring->id]);

            return redirect()->route('admin.ring.index')->with('success', 'ring added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating ring:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $ring = RingPackage::findOrFail($id);
        return view('admin.rings.edit', compact('ring'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'package_name' => 'required|string|max:255',
               
                'sub_package_name' => 'required|array|min:1',
                'sub_package_name.*' => 'required|string|max:255',
                  'sub_package_price' => 'required|array|min:1',
                'sub_package_price.*' => 'required|string|max:255',
                  'sub_package_subtitle' => 'required|array|min:1',
                'sub_package_subtitle.*' => 'required|string|max:255',
                  'sub_package_couples' => 'required|array|min:1',
                'sub_package_couples.*' => 'required|string|max:255',
                'sub_package_rings' => 'required|array|min:1',
                'sub_package_rings.*' => 'required|string|max:255'
            ]);

            $ring = RingPackage::findOrFail($id);
            $ring->update([
            'package_name' => $request->package_name,
                'sub_package_name' => json_encode($request->sub_package_name),
                'sub_package_price' => json_encode($request->sub_package_price),
                'sub_package_subtitle' => json_encode($request->sub_package_subtitle),
                'sub_package_couples' => json_encode($request->sub_package_couples),
                'sub_package_rings' => json_encode($request->sub_package_rings),
            ]);

            return redirect()->route('admin.ring.index')->with('success', 'ring updated successfully.');
        } catch (\Exception $e) {
            Log::error('ring update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $ring = RingPackage::findOrFail($id);
            $ring->delete();
            return redirect()->route('admin.ring.index')->with('success', 'ring deleted successfully.');
        } catch (\Exception $e) {
            Log::error('ring delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete ring.');
        }
    }
}
