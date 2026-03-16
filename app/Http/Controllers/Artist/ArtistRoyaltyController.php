<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\ArtistEarning;
use App\Models\PayoutRequest;
use App\Models\RoyaltyCalculation;
use App\Models\TransactionHistory;
use App\Models\ArtistWallet;
use App\Models\ArtistMusic;
use App\Models\StreamStat;
use App\Models\DownloadStat;
use App\Services\RoyaltyCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ArtistRoyaltyController extends Controller
{
    public function index()
    {
        $artistId = Auth::id();

        // Get or create wallet
        $wallet = ArtistWallet::getOrCreateForArtist($artistId);
        
        $availableBalance = $wallet->available_balance;
        $pendingBalance = $wallet->pending_balance;
        $totalEarned = $wallet->total_earned;
        $totalPaidOut = $wallet->total_paid_out;

        // Get total streams and downloads (all time)
        $totalStreams = StreamStat::where('artist_id', $artistId)
            ->where('is_complete', true)
            ->count();
        
        $totalDownloads = DownloadStat::where('artist_id', $artistId)->count();

        // Get current month stats
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        $currentMonthStreams = StreamStat::where('artist_id', $artistId)
            ->whereBetween('streamed_at', [$currentMonthStart, $currentMonthEnd])
            ->where('is_complete', true)
            ->count();

        $currentMonthDownloads = DownloadStat::where('artist_id', $artistId)
            ->whereBetween('downloaded_at', [$currentMonthStart, $currentMonthEnd])
            ->count();

        // Get recent earnings (last 10)
        $recentEarnings = ArtistEarning::where('artist_id', $artistId)
            ->with('music')
            ->latest('period_date')
            ->take(10)
            ->get();

        // Get royalty calculations (last 12 months)
        $royaltyCalculations = RoyaltyCalculation::where('artist_id', $artistId)
            ->latest('calculation_period')
            ->take(12)
            ->get();

        // Get per-track earnings for current month (from actual earnings records)
        $perTrackEarnings = ArtistEarning::where('artist_id', $artistId)
            ->whereYear('period_date', $currentYear)
            ->whereMonth('period_date', $currentMonth)
            ->whereNotNull('music_id')
            ->with('music')
            ->select('music_id', DB::raw('SUM(gross_amount) as gross_revenue'), DB::raw('SUM(platform_fee) as platform_fee'), DB::raw('SUM(net_amount) as net_amount'))
            ->groupBy('music_id')
            ->get()
            ->map(function($earning) {
                $trackStreams = StreamStat::where('music_id', $earning->music_id)
                    ->whereYear('streamed_at', now()->year)
                    ->whereMonth('streamed_at', now()->month)
                    ->where('is_complete', true)
                    ->count();
                
                return [
                    'track_id' => $earning->music_id,
                    'track_name' => $earning->music ? $earning->music->name : 'Unknown',
                    'streams' => $trackStreams,
                    'gross_revenue' => (float)$earning->gross_revenue,
                    'platform_fee' => (float)$earning->platform_fee,
                    'net_amount' => (float)$earning->net_amount,
                ];
            })
            ->toArray();

        // Get pending payout requests
        $pendingPayouts = PayoutRequest::where('artist_id', $artistId)
            ->whereIn('status', ['pending', 'processing'])
            ->sum('requested_amount');

        return view('artist.royalty.index', compact(
            'wallet',
            'availableBalance',
            'pendingBalance',
            'totalEarned',
            'totalPaidOut',
            'totalStreams',
            'totalDownloads',
            'currentMonthStreams',
            'currentMonthDownloads',
            'recentEarnings',
            'royaltyCalculations',
            'perTrackEarnings',
            'pendingPayouts'
        ));
    }

    public function earnings(Request $request)
    {
        $artistId = Auth::id();

        $query = ArtistEarning::where('artist_id', $artistId);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        }

        $earnings = $query->latest('period_date')->paginate(20);

        return view('artist.royalty.earnings', compact('earnings'));
    }

    public function payoutRequests()
    {
        $artistId = Auth::id();

        $requests = PayoutRequest::where('artist_id', $artistId)
            ->latest('requested_at')
            ->paginate(20);

        $wallet = ArtistWallet::getOrCreateForArtist($artistId);
        $availableBalance = $wallet->available_balance;

        return view('artist.royalty.payout-requests', compact('requests', 'availableBalance', 'wallet'));
    }

    public function requestPayout(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:50',
            'payout_method' => 'required|string|in:bank_transfer,paypal,wise,other',
            'account_details' => 'required|string',
        ]);

        $artistId = Auth::id();
        $wallet = ArtistWallet::getOrCreateForArtist($artistId);
        $availableBalance = $wallet->available_balance;
        $requestedAmount = $request->amount;

        if ($requestedAmount > $availableBalance) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Requested amount exceeds available balance. Available: $' . number_format($availableBalance, 2)
                ], 400);
            }
            return back()->with('error', 'Requested amount exceeds available balance. Available: $' . number_format($availableBalance, 2));
        }

        if ($requestedAmount < 50) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Minimum payout amount is $50.00.'
                ], 400);
            }
            return back()->with('error', 'Minimum payout amount is $50.00.');
        }

        // Don't deduct yet - will be deducted when payout is approved by admin
        $payoutRequest = PayoutRequest::create([
            'artist_id' => $artistId,
            'requested_amount' => $requestedAmount,
            'available_balance' => $availableBalance,
            'currency' => $request->currency ?? 'USD',
            'payout_method' => $request->payout_method,
            'account_details' => $request->account_details,
            'artist_notes' => $request->notes ?? null,
            'status' => 'pending',
        ]);

        // Notify artist that payout request was submitted
        try {
            $artist = Auth::user();
            if ($artist) {
                $message = "Your payout request of $" . number_format($requestedAmount, 2) . 
                    " has been submitted and is pending admin approval. You will be notified once it's processed.";
                app('notificationService')->notifyUsers([$artist], $message, 'Payout Request Submitted', 'payment');
            }
        } catch (\Throwable $e) {
            // Ignore notification failures
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Payout request submitted successfully. It will be processed within 3-5 business days.'
            ]);
        }

        return back()->with('success', 'Payout request submitted successfully. It will be processed within 3-5 business days.');
    }

    /**
     * Export earnings as CSV
     */
    public function exportEarningsCSV(Request $request)
    {
        $artistId = Auth::id();
        
        $query = ArtistEarning::where('artist_id', $artistId)
            ->with('music');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        }

        $earnings = $query->latest('period_date')->get();

        $filename = 'earnings_' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($earnings) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, [
                'Period Date',
                'Track Name',
                'Earnings Type',
                'Streams',
                'Gross Amount',
                'Platform Fee',
                'Net Amount',
                'Currency',
                'Status',
                'Processed At'
            ]);

            // Data rows
            foreach ($earnings as $earning) {
                fputcsv($file, [
                    $earning->period_date->format('Y-m-d'),
                    $earning->music ? $earning->music->name : 'N/A',
                    ucfirst($earning->earnings_type),
                    $earning->stream ? '1' : '0',
                    number_format($earning->gross_amount, 2),
                    number_format($earning->platform_fee, 2),
                    number_format($earning->net_amount, 2),
                    $earning->currency,
                    ucfirst($earning->status),
                    $earning->processed_at ? $earning->processed_at->format('Y-m-d H:i:s') : 'N/A',
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Export royalty report as PDF
     */
    public function exportRoyaltyReportPDF(Request $request)
    {
        $artistId = Auth::id();
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $royaltyCalculation = RoyaltyCalculation::where('artist_id', $artistId)
            ->whereYear('calculation_period', $year)
            ->whereMonth('calculation_period', $month)
            ->first();

        if (!$royaltyCalculation) {
            return back()->with('error', 'No royalty calculation found for the selected period.');
        }

        // Get per-track breakdown
        $royaltyService = new RoyaltyCalculationService();
        $perTrackEarnings = $royaltyService->calculatePerTrackEarnings($artistId, $month, $year);

        // For now, return CSV as PDF export requires additional packages
        // In production, you would use packages like dompdf or barryvdh/laravel-dompdf
        return $this->exportEarningsCSV($request);
    }

    /**
     * Get per-track earnings breakdown
     */
    public function perTrackEarnings(Request $request)
    {
        $artistId = Auth::id();
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $royaltyService = new RoyaltyCalculationService();
        $perTrackEarnings = $royaltyService->calculatePerTrackEarnings($artistId, $month, $year);

        return response()->json([
            'success' => true,
            'data' => $perTrackEarnings,
        ]);
    }

    public function transactionHistory(Request $request)
    {
        $artistId = Auth::id();

        $query = TransactionHistory::where('artist_id', $artistId);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('transaction_date', [$request->start_date, $request->end_date]);
        }

        $transactions = $query->latest('transaction_date')->paginate(20);

        return view('artist.royalty.transactions', compact('transactions'));
    }
}
