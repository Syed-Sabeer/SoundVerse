<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceArtistSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminServiceArtistSubscriptionController extends Controller
{
    public function index()
    {
        $services = ServiceArtistSubscription::all();
        return view('admin.services.artisit-subscription.index', compact('services'));
    }

    public function add()
    {
        return view('admin.services.artisit-subscription.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
            ]);

            $service = ServiceArtistSubscription::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            Log::info('Artist Subscription Service created successfully.', ['id' => $service->id]);

            return redirect()->route('admin.service.artistsubscription.index')->with('success', 'Artist Subscription Service added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating artist subscription service:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $service = ServiceArtistSubscription::findOrFail($id);
        return view('admin.services.artisit-subscription.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
            ]);

            $service = ServiceArtistSubscription::findOrFail($id);
            $service->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.service.artistsubscription.index')->with('success', 'Artist Subscription Service updated successfully.');
        } catch (\Exception $e) {
            Log::error('Artist Subscription Service update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $service = ServiceArtistSubscription::findOrFail($id);
            $service->delete();
            return redirect()->route('admin.service.artistsubscription.index')->with('success', 'Artist Subscription Service deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Artist Subscription Service delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete artist subscription service.');
        }
    }
}










