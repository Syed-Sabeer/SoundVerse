<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminSubscriptionPlanController extends Controller
{
  
public function index()
{
    $subplans = SubscriptionPlan::all();
    return view('admin.subplan.index', compact('subplans'));
}


  public function add()
  {
    return view('admin.subplan.add');
  }

public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'duration' => 'required|integer|max:255',
        ]);

        $subplan = SubscriptionPlan::create($validatedData);

        return redirect()->route('admin.subplan.index')->with('success', 'Subscription plan added successfully.');
    } catch (\Exception $e) {
        Log::error('Error while creating subscription plan:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors('Something went wrong.')->withInput();
    }
}


public function edit($id)
{
    $subplan = SubscriptionPlan::findOrFail($id);
    return view('admin.subplan.edit', compact('subplan'));
}


public function update(Request $request, $id)
{
    try {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'duration' => 'required|integer|max:255',
        ]);

        $subplan = SubscriptionPlan::findOrFail($id);
        $subplan->update($validatedData);

        return redirect()->route('admin.subplan.index')->with('success', 'Subscription plan updated successfully.');
    } catch (\Exception $e) {
        Log::error('Subscription plan update error:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors('Update failed.')->withInput();
    }
}


public function destroy($id)
{
    try {
        $subplan = SubscriptionPlan::findOrFail($id);
        $subplan->delete();
        return redirect()->route('admin.subplan.index')->with('success', 'subplan deleted successfully.');
    } catch (\Exception $e) {
        Log::error('subplan delete error:', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors('Could not delete subplan.');
    }
}



}
