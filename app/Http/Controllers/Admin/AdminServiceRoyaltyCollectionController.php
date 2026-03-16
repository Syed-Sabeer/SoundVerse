<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRoyaltyCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminServiceRoyaltyCollectionController extends Controller
{
    public function index()
    {
        $services = ServiceRoyaltyCollection::all();
        return view('admin.services.royaltycollection.index', compact('services'));
    }

    public function add()
    {
        return view('admin.services.royaltycollection.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'icon' => 'required|string',
                'description' => 'required',
                'button_link' => 'required|string',
                'include' => 'required|array|min:1',
                'include.*' => 'required|string'
            ]);

            $service = ServiceRoyaltyCollection::create([
                'title' => $request->title,
                'icon' => $request->icon,
                'description' => $request->description,
                'button_link' => $request->button_link,
                'include' => json_encode($request->include),
            ]);

            Log::info('Royalty Collection Service created successfully.', ['id' => $service->id]);

            return redirect()->route('admin.service.royaltycollection.index')->with('success', 'Royalty Collection Service added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating royalty collection service:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $service = ServiceRoyaltyCollection::findOrFail($id);
        return view('admin.services.royaltycollection.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'icon' => 'required|string',
                'description' => 'required',
                'button_link' => 'required|string',
                'include' => 'required|array|min:1',
                'include.*' => 'required|string'
            ]);

            $service = ServiceRoyaltyCollection::findOrFail($id);
            $service->update([
                'title' => $request->title,
                'icon' => $request->icon,
                'description' => $request->description,
                'button_link' => $request->button_link,
                'include' => json_encode($request->include),
            ]);

            return redirect()->route('admin.service.royaltycollection.index')->with('success', 'Royalty Collection Service updated successfully.');
        } catch (\Exception $e) {
            Log::error('Royalty Collection Service update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $service = ServiceRoyaltyCollection::findOrFail($id);
            $service->delete();
            return redirect()->route('admin.service.royaltycollection.index')->with('success', 'Royalty Collection Service deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Royalty Collection Service delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete royalty collection service.');
        }
    }
}
