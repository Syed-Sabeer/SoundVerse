<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\ArtistAnalytics;
use App\Models\ArtistPerformance;
use App\Models\StreamStat;
use App\Models\DownloadStat;
use App\Models\AudienceDemographic;
use App\Models\ArtistMusic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArtistAnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $artistId = Auth::id();

        // Get overview statistics
        $totalStreams = StreamStat::where('artist_id', $artistId)->where('is_complete', true)->count();
        $totalDownloads = DownloadStat::where('artist_id', $artistId)->count();
        
        $totalEarnings = DB::table('artist_earnings')
            ->where('artist_id', $artistId)
            ->where('status', 'processed')
            ->sum('net_amount');

        $pendingEarnings = DB::table('artist_earnings')
            ->where('artist_id', $artistId)
            ->where('status', 'pending')
            ->sum('net_amount');

        // Get performance data
        $query = ArtistPerformance::where('artist_id', $artistId);
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        } else {
            // Default to last 6 months
            $query->where('period_date', '>=', now()->subMonths(6));
        }

        $performances = $query->orderBy('period_date', 'asc')->get();

        // Get top tracks
        $topTracks = ArtistMusic::where('driver_id', $artistId)
            ->withCount(['streamStats' => function($query) {
                $query->where('is_complete', true);
            }])
            ->orderBy('stream_stats_count', 'desc')
            ->take(10)
            ->get();

        // Get demographics
        $demographics = AudienceDemographic::where('artist_id', $artistId)
            ->select('country', DB::raw('SUM(stream_count) as total_streams'))
            ->groupBy('country')
            ->orderBy('total_streams', 'desc')
            ->take(10)
            ->get();

        return view('artist.analytics.index', compact(
            'totalStreams',
            'totalDownloads',
            'totalEarnings',
            'pendingEarnings',
            'performances',
            'topTracks',
            'demographics'
        ));
    }

    public function export(Request $request)
    {
        $artistId = Auth::id();

        $query = ArtistPerformance::where('artist_id', $artistId);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        }

        $data = $query->get();

        // Generate CSV or PDF export
        // Implementation depends on your export library
        return response()->json(['message' => 'Export functionality to be implemented']);
    }

    public function demographics(Request $request)
    {
        $artistId = Auth::id();

        $query = AudienceDemographic::where('artist_id', $artistId);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        }

        $demographics = $query->latest()->paginate(20);

        return view('artist.analytics.demographics', compact('demographics'));
    }
}
