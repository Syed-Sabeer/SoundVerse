<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    public function toggleVisibility(Request $request, $id)
    {
        try {
            $faq = Faq::findOrFail($id);
            // Toggle the visibility: if it's 1, make it 0; if it's 0, make it 1
            $faq->visibility = $faq->visibility ? 0 : 1;
            $faq->save();
            
            return redirect()->route('admin.faq.index')->with('success', 'FAQ visibility updated successfully.');
        } catch (\Exception $e) {
            Log::error('FAQ visibility toggle error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not update FAQ visibility.');
        }
    }
  public function index()
  {
    $faqs = Faq::all();
  return view('admin.crud.faqs.index', compact('faqs'));
  }

  public function add()
  {
    return view('admin.crud.faqs.add');
  }

public function store(Request $request)
{
    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'visibility' => 'nullable|integer',
        ]);

        $validatedData = $request->only(['title', 'description', 'visibility']);

        Log::info('Validated FAQ data:', $validatedData);

        $faq = Faq::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'visibility' => $validatedData['visibility'] ?? 1,
        ]);

        Log::info('FAQ created successfully:', ['id' => $faq->id]);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ added successfully.');
    } catch (\Exception $e) {
        Log::error('Error while creating FAQ:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors($e->getMessage())->withInput();
    }
}

public function edit($id)
{
    $faq = Faq::findOrFail($id);
    return view('admin.crud.faqs.edit', compact('faq'));
}


public function update(Request $request, $id)
{
    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'visibility' => 'nullable|integer',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update([
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => $request->visibility ?? 1,
        ]);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully.');
    } catch (\Exception $e) {
        Log::error('FAQ update error:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors($e->getMessage())->withInput();
    }
}

public function destroy($id)
{
    try {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ deleted successfully.');
    } catch (\Exception $e) {
        Log::error('FAQ delete error:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors('Could not delete FAQ.');
    }
}



}
