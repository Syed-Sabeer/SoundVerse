<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArtistSubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminArtistSubscriptionPlanController extends Controller
{
    public function index()
    {
        $plans = ArtistSubscriptionPlan::orderBy('sort_order')->orderBy('monthly_fee')->get();
        return view('admin.artist-subscription-plans.index', compact('plans'));
    }

    public function add()
    {
        return view('admin.artist-subscription-plans.add');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'plan_name' => 'required|string|max:255',
                'monthly_fee' => 'required|numeric|min:0',
                'currency' => 'required|string|size:3',
                'ideal_for' => 'nullable|string',
                'description' => 'nullable|string',
                'songs_per_month' => 'nullable|integer|min:0',
                'is_unlimited_uploads' => 'nullable|boolean',
                'is_featured_rotation' => 'nullable|boolean',
                'featured_rotation_weeks' => 'nullable|integer|min:0|max:4',
                'is_priority_search' => 'nullable|boolean',
                'is_custom_banner' => 'nullable|boolean',
                'is_isrc_codes' => 'nullable|boolean',
                'is_early_access_insights' => 'nullable|boolean',
                'is_certified_badge' => 'nullable|boolean',
                'is_showcase_placement' => 'nullable|boolean',
                'is_royalty_tracking' => 'nullable|boolean',
                'is_playlist_highlighted' => 'nullable|boolean',
                'is_advanced_analytics' => 'nullable|boolean',
                'is_showcase_invitations' => 'nullable|boolean',
                'is_active' => 'nullable|boolean',
                'sort_order' => 'nullable|integer',
            ]);

            // Generate slug from plan name
            $validatedData['plan_slug'] = Str::slug($validatedData['plan_name']);

            // Convert checkbox values to boolean
            $booleanFields = [
                'is_unlimited_uploads', 'is_featured_rotation', 'is_priority_search',
                'is_custom_banner', 'is_isrc_codes', 'is_early_access_insights',
                'is_certified_badge', 'is_showcase_placement', 'is_royalty_tracking',
                'is_playlist_highlighted', 'is_advanced_analytics', 'is_showcase_invitations',
                'is_active'
            ];

            foreach ($booleanFields as $field) {
                $validatedData[$field] = $request->has($field) ? 1 : 0;
            }

            // Set songs_per_month to NULL if unlimited uploads
            if ($validatedData['is_unlimited_uploads']) {
                $validatedData['songs_per_month'] = null;
            }

            // Set featured_rotation_weeks to NULL if not featured rotation
            if (!$validatedData['is_featured_rotation']) {
                $validatedData['featured_rotation_weeks'] = null;
            }

            $plan = ArtistSubscriptionPlan::create($validatedData);

            Log::info('Artist Subscription Plan created successfully.', ['id' => $plan->id]);

            return redirect()->route('admin.artist-subscription-plans.index')->with('success', 'Artist Subscription Plan added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating artist subscription plan:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $plan = ArtistSubscriptionPlan::findOrFail($id);
        return view('admin.artist-subscription-plans.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'plan_name' => 'required|string|max:255',
                'monthly_fee' => 'required|numeric|min:0',
                'currency' => 'required|string|size:3',
                'ideal_for' => 'nullable|string',
                'description' => 'nullable|string',
                'songs_per_month' => 'nullable|integer|min:0',
                'is_unlimited_uploads' => 'nullable|boolean',
                'is_featured_rotation' => 'nullable|boolean',
                'featured_rotation_weeks' => 'nullable|integer|min:0|max:4',
                'is_priority_search' => 'nullable|boolean',
                'is_custom_banner' => 'nullable|boolean',
                'is_isrc_codes' => 'nullable|boolean',
                'is_early_access_insights' => 'nullable|boolean',
                'is_certified_badge' => 'nullable|boolean',
                'is_showcase_placement' => 'nullable|boolean',
                'is_royalty_tracking' => 'nullable|boolean',
                'is_playlist_highlighted' => 'nullable|boolean',
                'is_advanced_analytics' => 'nullable|boolean',
                'is_showcase_invitations' => 'nullable|boolean',
                'is_active' => 'nullable|boolean',
                'sort_order' => 'nullable|integer',
            ]);

            $plan = ArtistSubscriptionPlan::findOrFail($id);

            // Generate slug from plan name
            $validatedData['plan_slug'] = Str::slug($validatedData['plan_name']);

            // Convert checkbox values to boolean
            $booleanFields = [
                'is_unlimited_uploads', 'is_featured_rotation', 'is_priority_search',
                'is_custom_banner', 'is_isrc_codes', 'is_early_access_insights',
                'is_certified_badge', 'is_showcase_placement', 'is_royalty_tracking',
                'is_playlist_highlighted', 'is_advanced_analytics', 'is_showcase_invitations',
                'is_active'
            ];

            foreach ($booleanFields as $field) {
                $validatedData[$field] = $request->has($field) ? 1 : 0;
            }

            // Set songs_per_month to NULL if unlimited uploads
            if ($validatedData['is_unlimited_uploads']) {
                $validatedData['songs_per_month'] = null;
            }

            // Set featured_rotation_weeks to NULL if not featured rotation
            if (!$validatedData['is_featured_rotation']) {
                $validatedData['featured_rotation_weeks'] = null;
            }

            $plan->update($validatedData);

            return redirect()->route('admin.artist-subscription-plans.index')->with('success', 'Artist Subscription Plan updated successfully.');
        } catch (\Exception $e) {
            Log::error('Artist Subscription Plan update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $plan = ArtistSubscriptionPlan::findOrFail($id);
            
            // Check if any users are subscribed to this plan
            $subscribedCount = $plan->subscribedUsers()->count();
            if ($subscribedCount > 0) {
                return redirect()->back()->withErrors("Cannot delete plan. {$subscribedCount} artist(s) are currently subscribed to this plan.");
            }

            $plan->delete();
            return redirect()->route('admin.artist-subscription-plans.index')->with('success', 'Artist Subscription Plan deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Artist Subscription Plan delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete artist subscription plan.');
        }
    }
}
