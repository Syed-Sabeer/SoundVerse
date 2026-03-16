<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminNewsletterController extends Controller
{
    public function toggleVisibility(Request $request, $id)
    {
        try {
            $newsletter = Newsletter::findOrFail($id);
            // Toggle the visibility: if it's 1, make it 0; if it's 0, make it 1
            $newsletter->visibility = $newsletter->visibility ? 0 : 1;
            $newsletter->save();
            
            return redirect()->route('admin.newsletter.index')->with('success', 'Newsletter visibility updated successfully.');
        } catch (\Exception $e) {
            Log::error('Newsletter visibility toggle error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not update newsletter visibility.');
        }
    }
  public function index()
  {
    $newsletters = Newsletter::all();
  return view('admin.newsletter.index', compact('newsletters'));
  }

  public function add()
  {
    return view('admin.newsletter.add');
  }

public function store(Request $request)
{
    try {
        $request->validate([
            'title' => 'required|string|max:255',
          
            'visibility' => 'nullable|integer',
        ]);

        $validatedData = $request->only(['title', 'description', 'visibility']);

        Log::info('Validated Newsletter data:', $validatedData);

        $newsletter = Newsletter::create([
            'title' => $validatedData['title'],
           
            'visibility' => $validatedData['visibility'] ?? 1,
        ]);

        Log::info('newsletter created successfully:', ['id' => $newsletter->id]);

        return redirect()->route('admin.newsletter.index')->with('success', 'newsletter added successfully.');
    } catch (\Exception $e) {
        Log::error('Error while creating newsletter:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors($e->getMessage())->withInput();
    }
}

public function edit($id)
{
    $newsletter = Newsletter::findOrFail($id);
    return view('admin.newsletter.edit', compact('newsletter'));
}


public function update(Request $request, $id)
{
    try {
        $request->validate([
            'title' => 'required|string|max:255',
         
            'visibility' => 'nullable|integer',
        ]);

        $newsletter = Newsletter::findOrFail($id);
        $newsletter->update([
            'title' => $request->title,
            
            'visibility' => $request->visibility ?? 1,
        ]);

        return redirect()->route('admin.newsletter.index')->with('success', 'newsletter updated successfully.');
    } catch (\Exception $e) {
        Log::error('newsletter update error:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors($e->getMessage())->withInput();
    }
}

public function destroy($id)
{
    try {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();
        return redirect()->route('admin.newsletter.index')->with('success', 'newsletter deleted successfully.');
    } catch (\Exception $e) {
        Log::error('newsletter delete error:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors('Could not delete newsletter.');
    }
}



}
