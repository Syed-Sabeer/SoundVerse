<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdRevenueShare;
use App\Models\AdImpression;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAdRevenueController extends Controller
{
    public function index(Request $request)
    {
        $query = AdRevenueShare::with(['artist', 'ad']);

        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $revenueShares = $query->latest('period_date')->paginate(20);
        $artists = User::where('is_artist', true)->get();

        // Summary statistics
        $totalRevenue = AdRevenueShare::sum('total_ad_revenue');
        $totalArtistShares = AdRevenueShare::sum('artist_share_amount');
        $totalPlatformShares = AdRevenueShare::sum('platform_share_amount');
        $pendingPayouts = AdRevenueShare::where('status', 'pending')->sum('artist_share_amount');

        return view('admin.ad-revenue.index', compact(
            'revenueShares',
            'artists',
            'totalRevenue',
            'totalArtistShares',
            'totalPlatformShares',
            'pendingPayouts'
        ));
    }

    public function impressions(Request $request)
    {
        $query = AdImpression::with(['ad', 'artist', 'music', 'user']);

        if ($request->filled('ad_id')) {
            $query->where('ad_id', $request->ad_id);
        }

        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('viewed_at', [$request->start_date, $request->end_date]);
        }

        $impressions = $query->latest('viewed_at')->paginate(50);

        // Statistics
        $totalImpressions = AdImpression::count();
        $totalClicks = AdImpression::where('clicked', true)->count();
        $totalRevenue = AdImpression::sum('revenue');
        $clickThroughRate = $totalImpressions > 0 ? ($totalClicks / $totalImpressions) * 100 : 0;

        return view('admin.ad-revenue.impressions', compact(
            'impressions',
            'totalImpressions',
            'totalClicks',
            'totalRevenue',
            'clickThroughRate'
        ));
    }

    public function calculateRevenue(Request $request)
    {
        $request->validate([
            'period_date' => 'required|date',
            'artist_share_percentage' => 'required|numeric|min:0|max:100',
        ]);

        // Calculate ad revenue shares for the period
        // This would typically be done via a scheduled job
        return back()->with('success', 'Revenue calculation initiated.');
    }

    public function markPaid($id)
    {
        $revenueShare = AdRevenueShare::findOrFail($id);
        $revenueShare->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return back()->with('success', 'Revenue share marked as paid.');
    }
}
