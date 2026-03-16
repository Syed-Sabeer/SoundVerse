<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutRequest;
use App\Models\RoyaltyCalculation;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Models\ArtistWallet;
use App\Models\PayoutHistory;
use App\Models\PlatformRevenueTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoyaltyController extends Controller
{
    public function index(Request $request)
    {
        $query = RoyaltyCalculation::with('artist');

        // Filter by artist
        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('calculation_period', [$request->start_date, $request->end_date]);
        }

        $calculations = $query->latest('calculation_period')->paginate(20);
        $artists = User::where('is_artist', true)->get();

        // Summary statistics - from royalty calculations
        $totalRevenue = RoyaltyCalculation::sum('total_gross_revenue');
        $totalPlatformFee = RoyaltyCalculation::sum('platform_fee_amount');
        $totalArtistPayments = RoyaltyCalculation::sum('artist_royalty_amount');
        $pendingPayments = RoyaltyCalculation::where('status', 'pending')->sum('artist_royalty_amount');
        
        // Platform revenue tracking (set by admin)
        $platformRevenues = PlatformRevenueTracking::orderBy('period_year', 'desc')
            ->orderBy('period_month', 'desc')
            ->get();
        $totalPlatformRevenueSet = PlatformRevenueTracking::sum('total_platform_revenue');

        return view('admin.royalty.index', compact(
            'calculations',
            'artists',
            'totalRevenue',
            'totalPlatformFee',
            'totalArtistPayments',
            'pendingPayments',
            'platformRevenues',
            'totalPlatformRevenueSet'
        ));
    }

    public function payoutRequests(Request $request)
    {
        $query = PayoutRequest::with(['artist', 'approver', 'rejector']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by artist
        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        $requests = $query->latest('requested_at')->paginate(20);
        $artists = User::where('is_artist', true)->get();

        return view('admin.royalty.payout-requests', compact('requests', 'artists'));
    }

    public function showPayoutRequest($id)
    {
        $payoutRequest = PayoutRequest::with(['artist', 'approver', 'rejector'])->findOrFail($id);
        return view('admin.royalty.payout-show', compact('payoutRequest'));
    }

    public function approvePayout($id, Request $request)
    {
        $payoutRequest = PayoutRequest::findOrFail($id);

        if ($payoutRequest->status !== 'pending') {
            return back()->with('error', 'Payout request cannot be approved.');
        }

        // Verify wallet has sufficient balance
        $wallet = ArtistWallet::getOrCreateForArtist($payoutRequest->artist_id);
        if ($wallet->available_balance < $payoutRequest->requested_amount) {
            return back()->with('error', 'Artist wallet has insufficient balance.');
        }

        DB::beginTransaction();
        try {
            // Handle file attachment
            $attachmentPath = null;
            if ($request->hasFile('attachment_file')) {
                $file = $request->file('attachment_file');
                $attachmentPath = $file->store('payout-attachments', 'public');
            }

            // Deduct from wallet
            $wallet->deduct($payoutRequest->requested_amount);

            // Update payout request
            $payoutRequest->update([
                'status' => 'processing',
                'approved_by' => auth()->id(),
                'admin_notes' => $request->admin_notes,
                'attachment_file' => $attachmentPath,
                'processed_at' => now(),
            ]);

            // Create payout history record
            PayoutHistory::create([
                'payout_request_id' => $payoutRequest->id,
                'artist_id' => $payoutRequest->artist_id,
                'amount' => $payoutRequest->requested_amount,
                'currency' => $payoutRequest->currency,
                'payout_method' => $payoutRequest->payout_method,
                'status' => 'processing',
                'processed_at' => now(),
            ]);

            DB::commit();

            // Notify artist about payout approval
            try {
                $artist = User::find($payoutRequest->artist_id);
                if ($artist) {
                    $message = "Your payout request of $" . number_format($payoutRequest->requested_amount, 2) . " has been approved and is being processed.";
                    app('notificationService')->notifyUsers([$artist], $message, 'Payout Approved', 'payment');
                }
            } catch (\Throwable $e) {
                // Ignore notification failures
            }

            return back()->with('success', 'Payout request approved and wallet deducted. Payment processing can now proceed.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error approving payout: ' . $e->getMessage());
        }
    }

    public function completePayout($id, Request $request)
    {
        $payoutRequest = PayoutRequest::findOrFail($id);

        if ($payoutRequest->status !== 'processing') {
            return back()->with('error', 'Payout request must be in processing status.');
        }

        $payoutRequest->update([
            'status' => 'completed',
            'processed_at' => now(),
        ]);

        // Update payout history
        $payoutHistory = PayoutHistory::where('payout_request_id', $payoutRequest->id)->first();
        if ($payoutHistory) {
            $payoutHistory->update([
                'status' => 'completed',
                'transaction_id' => $request->transaction_id,
                'completed_at' => now(),
            ]);
        }

        // Notify artist about payout completion
        try {
            $artist = User::find($payoutRequest->artist_id);
            if ($artist) {
                $message = "Your payout of $" . number_format($payoutRequest->requested_amount, 2) . " has been completed and sent to your " . $payoutRequest->payout_method . " account.";
                app('notificationService')->notifyUsers([$artist], $message, 'Payout Completed', 'payment');
            }
        } catch (\Throwable $e) {
            // Ignore notification failures
        }

        return back()->with('success', 'Payout marked as completed.');
    }

    public function rejectPayout($id, Request $request)
    {
        $payoutRequest = PayoutRequest::findOrFail($id);

        // If it was already processing and wallet was deducted, refund it
        if ($payoutRequest->status === 'processing') {
            $wallet = ArtistWallet::getOrCreateForArtist($payoutRequest->artist_id);
            $wallet->increment('available_balance', $payoutRequest->requested_amount);
            $wallet->decrement('total_paid_out', $payoutRequest->requested_amount);
        }

        // Handle file attachment
        $attachmentPath = null;
        if ($request->hasFile('attachment_file')) {
            $file = $request->file('attachment_file');
            $attachmentPath = $file->store('payout-attachments', 'public');
        }

        $payoutRequest->update([
            'status' => 'rejected',
            'rejected_by' => auth()->id(),
            'admin_notes' => $request->admin_notes,
            'attachment_file' => $attachmentPath,
        ]);

        // Notify artist about payout rejection
        try {
            $artist = User::find($payoutRequest->artist_id);
            if ($artist) {
                $reason = $request->admin_notes ? " Reason: " . $request->admin_notes : "";
                $message = "Your payout request of $" . number_format($payoutRequest->requested_amount, 2) . " has been rejected." . $reason;
                app('notificationService')->notifyUsers([$artist], $message, 'Payout Rejected', 'payment');
            }
        } catch (\Throwable $e) {
            // Ignore notification failures
        }

        return back()->with('success', 'Payout request rejected.');
    }

    /**
     * Set platform revenue for a specific period
     */
    public function setPlatformRevenue(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2020',
            'revenue' => 'required|numeric|min:0',
            'revenue_source' => 'nullable|in:subscriptions,ads,purchases,other',
        ]);

        $platformRevenue = \App\Models\PlatformRevenueTracking::updateOrCreate(
            [
                'period_month' => $request->month,
                'period_year' => $request->year,
            ],
            [
                'total_platform_revenue' => $request->revenue,
                'revenue_source' => $request->revenue_source ?? 'subscriptions',
                'status' => 'confirmed',
            ]
        );

        return back()->with('success', "Platform revenue set to $" . number_format($request->revenue, 2) . " for " . 
            \Carbon\Carbon::create($request->year, $request->month, 1)->format('F Y'));
    }

    /**
     * Calculate royalties for a specific period
     */
    public function calculateRoyalties(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2020',
        ]);

        try {
            $royaltyService = new \App\Services\RoyaltyCalculationService();
            $calculations = $royaltyService->calculateRoyaltiesForPeriod(
                $request->month,
                $request->year
            );

            return back()->with('success', 'Royalties calculated successfully for ' . 
                \Carbon\Carbon::create($request->year, $request->month, 1)->format('F Y') . 
                '. Processed ' . count($calculations) . ' artists.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error calculating royalties: ' . $e->getMessage());
        }
    }

    public function generateReport(Request $request)
    {
        $query = RoyaltyCalculation::with('artist');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('calculation_period', [$request->start_date, $request->end_date]);
        }

        $data = $query->get();

        // Generate report (CSV/PDF)
        return response()->json(['message' => 'Report generation to be implemented']);
    }
}
