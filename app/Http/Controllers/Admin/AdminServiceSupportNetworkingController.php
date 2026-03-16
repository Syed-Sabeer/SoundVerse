<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceSupportNetworking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminServiceSupportNetworkingController extends Controller
{
    public function index()
    {
        $services = ServiceSupportNetworking::all();
        return view('admin.services.supportnetworking.index', compact('services'));
    }

    public function add()
    {
        return view('admin.services.supportnetworking.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
            ]);

            $service = ServiceSupportNetworking::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            Log::info('Support Networking Service created successfully.', ['id' => $service->id]);

            return redirect()->route('admin.service.supportnetworking.index')->with('success', 'Support Networking Service added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating support networking service:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $service = ServiceSupportNetworking::findOrFail($id);
        return view('admin.services.supportnetworking.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
            ]);

            $service = ServiceSupportNetworking::findOrFail($id);
            $service->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.service.supportnetworking.index')->with('success', 'Support Networking Service updated successfully.');
        } catch (\Exception $e) {
            Log::error('Support Networking Service update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $service = ServiceSupportNetworking::findOrFail($id);
            $service->delete();
            return redirect()->route('admin.service.supportnetworking.index')->with('success', 'Support Networking Service deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Support Networking Service delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete support networking service.');
        }
    }
}










