<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminGiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::all();
        return view('admin.gifts.index', compact('gifts'));
    }

    public function add()
    {
        return view('admin.gifts.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'icon' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'rings_count' => 'required|string|max:255',
                'description' => 'required',
                'couples_connected' => 'required',
                'includes' => 'required|array|min:1',
                'includes.*' => 'required|string|max:255'
            ]);

            $gift = Gift::create([
                'title' => $request->title,
                'icon' => $request->icon,
                'rings_count' => $request->rings_count,
                'price' => $request->price,
                'description' => $request->description,
                'couples_connected' => $request->couples_connected,
                'includes' => json_encode($request->includes),
            ]);

            Log::info('Gift created successfully.', ['id' => $gift->id]);

            return redirect()->route('admin.gift.index')->with('success', 'Gift added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating gift:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $gift = Gift::findOrFail($id);
        return view('admin.gifts.edit', compact('gift'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'icon' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'rings_count' => 'required|string|max:255',
                'description' => 'required',
                'couples_connected' => 'required',
                'includes' => 'required|array|min:1',
                'includes.*' => 'required|string|max:255'
            ]);

            $gift = Gift::findOrFail($id);
            $gift->update([
                'title' => $request->title,
                'icon' => $request->icon,
                'rings_count' => $request->rings_count,
                'price' => $request->price,
                'description' => $request->description,
                'couples_connected' => $request->couples_connected,
                'includes' => json_encode($request->includes),
            ]);

            return redirect()->route('admin.gift.index')->with('success', 'Gift updated successfully.');
        } catch (\Exception $e) {
            Log::error('Gift update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $gift = Gift::findOrFail($id);
            $gift->delete();
            return redirect()->route('admin.gift.index')->with('success', 'Gift deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Gift delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete gift.');
        }
    }
}
