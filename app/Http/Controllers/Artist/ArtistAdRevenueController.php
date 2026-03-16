<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\AdRevenueShare;
use App\Models\AdImpression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArtistAdRevenueController extends Controller
{
    public function index(Request $request)
    {
        $artistId = Auth::id();

        $query = AdRevenueShare::where('artist_id', $artistId);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        }

        $revenueShares = $query->latest('period_date')->paginate(20);

        // Summary
        $totalRevenue = AdRevenueShare::where('artist_id', $artistId)->sum('total_ad_revenue');
        $totalEarnings = AdRevenueShare::where('artist_id', $artistId)->sum('artist_share_amount');
        $pendingEarnings = AdRevenueShare::where('artist_id', $artistId)
            ->where('status', 'pending')
            ->sum('artist_share_amount');

        // Recent impressions
        $recentImpressions = AdImpression::where('artist_id', $artistId)
            ->latest('viewed_at')
            ->take(10)
            ->get();

        return view('artist.ad-revenue.index', compact(
            'revenueShares',
            'totalRevenue',
            'totalEarnings',
            'pendingEarnings',
            'recentImpressions'
        ));
    }
}
