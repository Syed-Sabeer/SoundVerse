<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsbar;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminNewsbarController extends Controller
{
  
  public function index()
  {
    $newsbars = Newsbar::all();
  return view('admin.crud.newsbar.index', compact('newsbars'));
  }

  public function add()
  {
    return view('admin.crud.newsbar.add');
  }

public function store(Request $request)
{
    try {
        $request->validate([
            'title' => 'required|string|max:255',
          
            'visibility' => 'nullable|integer',
        ]);

        $validatedData = $request->only(['title', 'description', 'visibility']);

        Log::info('Validated newsbar data:', $validatedData);

        $newsbar = Newsbar::create([
            'title' => $validatedData['title'],
           
            'visibility' => $validatedData['visibility'] ?? 1,
        ]);

        Log::info('newsbar created successfully:', ['id' => $newsbar->id]);

        return redirect()->route('admin.newsbar.index')->with('success', 'newsbar added successfully.');
    } catch (\Exception $e) {
        Log::error('Error while creating newsbar:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors($e->getMessage())->withInput();
    }
}

public function edit($id)
{
    $newsbar = Newsbar::findOrFail($id);
    return view('admin.crud.newsbar.edit', compact('newsbar'));
}


public function update(Request $request, $id)
{
    try {
        $request->validate([
            'title' => 'required|string|max:255',
         
            'visibility' => 'nullable|integer',
        ]);

        $newsbar = Newsbar::findOrFail($id);
        $newsbar->update([
            'title' => $request->title,
            
            'visibility' => $request->visibility ?? 1,
        ]);

        return redirect()->route('admin.newsbar.index')->with('success', 'newsbar updated successfully.');
    } catch (\Exception $e) {
        Log::error('newsbar update error:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors($e->getMessage())->withInput();
    }
}

public function destroy($id)
{
    try {
        $newsbar = Newsbar::findOrFail($id);
        $newsbar->delete();
        return redirect()->route('admin.newsbar.index')->with('success', 'newsbar deleted successfully.');
    } catch (\Exception $e) {
        Log::error('newsbar delete error:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors('Could not delete newsbar.');
    }
}



}
