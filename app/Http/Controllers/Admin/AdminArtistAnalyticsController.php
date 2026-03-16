<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArtistAnalytics;
use App\Models\ArtistPerformance;
use App\Models\StreamStat;
use App\Models\DownloadStat;
use App\Models\AudienceDemographic;
use App\Models\ArtistTier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminArtistAnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $query = ArtistPerformance::with('artist');

        // Filter by artist
        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        }

        // Filter by period type
        if ($request->filled('period_type')) {
            $query->where('period_type', $request->period_type);
        }

        // Filter by tier
        if ($request->filled('tier_id')) {
            $artistIds = DB::table('artist_tier_assignments')
                ->where('tier_id', $request->tier_id)
                ->pluck('artist_id');
            $query->whereIn('artist_id', $artistIds);
        }

        $performances = $query->latest('period_date')->paginate(20);
        $artists = User::where('is_artist', true)->get();
        $tiers = ArtistTier::where('is_active', true)->get();

        // Aggregate statistics
        $totalArtists = User::where('is_artist', true)->count();
        $totalStreams = StreamStat::sum('is_complete');
        $totalDownloads = DownloadStat::count();
        $totalRevenue = ArtistPerformance::sum('total_revenue');

        return view('admin.analytics.index', compact(
            'performances',
            'artists',
            'tiers',
            'totalArtists',
            'totalStreams',
            'totalDownloads',
            'totalRevenue'
        ));
    }

    public function show($artistId, Request $request)
    {
        $artist = User::findOrFail($artistId);

        $query = ArtistPerformance::where('artist_id', $artistId);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        }

        $performances = $query->latest('period_date')->paginate(20);
        $analytics = ArtistAnalytics::where('artist_id', $artistId)->latest()->take(10)->get();
        $demographics = AudienceDemographic::where('artist_id', $artistId)->latest()->take(10)->get();

        return view('admin.analytics.show', compact('artist', 'performances', 'analytics', 'demographics'));
    }

    public function export(Request $request)
    {
        $query = ArtistPerformance::with('artist');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        }

        $data = $query->get();

        // Generate CSV or PDF export
        // Implementation depends on your export library
        return response()->json(['message' => 'Export functionality to be implemented']);
    }
}
