<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrackCollaboration;
use App\Models\CollaborationRevenueDistribution;
use App\Models\ArtistMusic;
use App\Models\StreamStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCollaborationRevenueController extends Controller
{
    /**
     * Calculate revenue for collaborative tracks for a specific period
     */
    public function calculateRevenue(Request $request)
    {
        $validated = $request->validate([
            'period_date' => 'required|date',
            'platform_fee_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $periodDate = $validated['period_date'];
        $platformFeePercentage = $validated['platform_fee_percentage'] ?? 20.00; // Default 20%

        // Get all active collaborations
        $collaborations = TrackCollaboration::where('status', 'active')
            ->with(['music', 'ownershipSplits'])
            ->get();

        DB::beginTransaction();
        try {
            foreach ($collaborations as $collaboration) {
                $music = $collaboration->music;

                // Calculate total streams for this music in the period
                $streamCount = StreamStat::where('music_id', $music->id)
                    ->where('is_complete', true)
                    ->whereDate('streamed_at', $periodDate)
                    ->count();

                if ($streamCount == 0) {
                    continue; // Skip if no streams
                }

                // Calculate total platform revenue (this would come from actual platform data)
                // For now, using a simple calculation: assuming $0.001 per stream
                $revenuePerStream = 0.001;
                $totalRevenue = $streamCount * $revenuePerStream;

                // Calculate platform fee
                $platformFee = $totalRevenue * ($platformFeePercentage / 100);

                // Artist share before split
                $artistShareBeforeSplit = $totalRevenue - $platformFee;

                // Distribute among all artists based on ownership percentages
                foreach ($collaboration->ownershipSplits as $split) {
                    $artistShare = $artistShareBeforeSplit * ($split->ownership_percentage / 100);

                    CollaborationRevenueDistribution::updateOrCreate(
                        [
                            'collaboration_id' => $collaboration->id,
                            'music_id' => $music->id,
                            'artist_id' => $split->artist_id,
                            'period_date' => $periodDate,
                        ],
                        [
                            'ownership_percentage' => $split->ownership_percentage,
                            'total_revenue' => $totalRevenue,
                            'platform_fee' => $platformFee * ($split->ownership_percentage / 100),
                            'artist_share_before_split' => $artistShareBeforeSplit,
                            'artist_share_after_split' => $artistShare,
                            'stream_count' => $streamCount,
                            'status' => 'calculated',
                        ]
                    );
                }
            }

            DB::commit();

            return back()->with('success', 'Revenue calculated successfully for ' . $periodDate);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to calculate revenue: ' . $e->getMessage());
        }
    }

    public function distributions(Request $request)
    {
        $query = CollaborationRevenueDistribution::with(['collaboration', 'music', 'artist']);

        if ($request->filled('collaboration_id')) {
            $query->where('collaboration_id', $request->collaboration_id);
        }

        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        }

        $distributions = $query->latest('period_date')->paginate(50);
        $collaborations = TrackCollaboration::where('status', 'active')->get();

        return view('admin.collaborations.distributions', compact('distributions', 'collaborations'));
    }

    public function markPaid(Request $request)
    {
        $validated = $request->validate([
            'distribution_ids' => 'required|array',
            'distribution_ids.*' => 'exists:collaboration_revenue_distributions,id',
        ]);

        CollaborationRevenueDistribution::whereIn('id', $validated['distribution_ids'])
            ->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

        return back()->with('success', 'Distributions marked as paid successfully.');
    }
}
