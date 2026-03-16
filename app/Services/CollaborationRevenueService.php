<?php

namespace App\Services;

use App\Models\TrackCollaboration;
use App\Models\CollaborationRevenueDistribution;
use App\Models\StreamStat;
use App\Models\ArtistEarning;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CollaborationRevenueService
{
    /**
     * Calculate revenue distribution for a collaborative track
     * 
     * @param TrackCollaboration $collaboration
     * @param string $periodDate (YYYY-MM-DD)
     * @param float $platformFeePercentage (default 20%)
     * @param float $revenuePerStream (default 0.001)
     * @return array
     */
    public function calculateRevenueDistribution($collaboration, $periodDate, $platformFeePercentage = 20.00, $revenuePerStream = 0.001)
    {
        $music = $collaboration->music;

        // Calculate total streams for this music in the period
        $streamCount = StreamStat::where('music_id', $music->id)
            ->where('is_complete', true)
            ->whereDate('streamed_at', $periodDate)
            ->count();

        if ($streamCount == 0) {
            return [
                'success' => false,
                'message' => 'No streams found for this period',
                'stream_count' => 0,
            ];
        }

        // Calculate total revenue (this should come from actual platform revenue data)
        $totalRevenue = $streamCount * $revenuePerStream;

        // Calculate platform fee (20% of total revenue)
        $platformFee = $totalRevenue * ($platformFeePercentage / 100);

        // Artist share before split (80% of total revenue)
        $artistShareBeforeSplit = $totalRevenue - $platformFee;

        $distributions = [];

        DB::beginTransaction();
        try {
            // Distribute among all artists based on ownership percentages
            foreach ($collaboration->ownershipSplits as $split) {
                // Calculate this artist's share based on their ownership percentage
                $artistShare = $artistShareBeforeSplit * ($split->ownership_percentage / 100);
                
                // Calculate this artist's portion of platform fee
                $artistPlatformFee = $platformFee * ($split->ownership_percentage / 100);

                $distribution = CollaborationRevenueDistribution::updateOrCreate(
                    [
                        'collaboration_id' => $collaboration->id,
                        'music_id' => $music->id,
                        'artist_id' => $split->artist_id,
                        'period_date' => $periodDate,
                    ],
                    [
                        'ownership_percentage' => $split->ownership_percentage,
                        'total_revenue' => $totalRevenue,
                        'platform_fee' => $artistPlatformFee,
                        'artist_share_before_split' => $artistShareBeforeSplit,
                        'artist_share_after_split' => $artistShare,
                        'stream_count' => $streamCount,
                        'status' => 'calculated',
                    ]
                );

                // Also create an earning record for the artist
                ArtistEarning::create([
                    'artist_id' => $split->artist_id,
                    'music_id' => $music->id,
                    'earnings_type' => 'stream',
                    'gross_amount' => $artistShareBeforeSplit * ($split->ownership_percentage / 100),
                    'platform_fee' => $artistPlatformFee,
                    'net_amount' => $artistShare,
                    'royalty_percentage' => $split->ownership_percentage,
                    'status' => 'processed',
                    'period_date' => $periodDate,
                    'processed_at' => now(),
                ]);

                $distributions[] = [
                    'artist_id' => $split->artist_id,
                    'artist_name' => $split->artist->name,
                    'ownership_percentage' => $split->ownership_percentage,
                    'artist_share' => $artistShare,
                ];
            }

            DB::commit();

            // Notify artists about collaborative revenue distribution
            try {
                foreach ($distributions as $dist) {
                    $artist = User::find($dist['artist_id']);
                    if ($artist && $dist['artist_share'] > 0) {
                        $message = "Collaborative track revenue distributed! You earned $" . 
                            number_format($dist['artist_share'], 2) . " from " . 
                            number_format($streamCount) . " streams (ownership: " . 
                            number_format($dist['ownership_percentage'], 1) . "%). Amount added to your wallet.";
                        app('notificationService')->notifyUsers([$artist], $message, 'Collaboration Revenue', 'payment');
                    }
                }
            } catch (\Throwable $e) {
                // Ignore notification failures
            }

            return [
                'success' => true,
                'message' => 'Revenue distributed successfully',
                'total_revenue' => $totalRevenue,
                'platform_fee' => $platformFee,
                'artist_share_before_split' => $artistShareBeforeSplit,
                'stream_count' => $streamCount,
                'distributions' => $distributions,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Failed to calculate revenue: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Calculate revenue for all active collaborations for a specific period
     */
    public function calculateAllCollaborations($periodDate, $platformFeePercentage = 20.00, $revenuePerStream = 0.001)
    {
        $collaborations = TrackCollaboration::where('status', 'active')
            ->with(['music', 'ownershipSplits.artist'])
            ->get();

        $results = [];
        foreach ($collaborations as $collaboration) {
            $result = $this->calculateRevenueDistribution($collaboration, $periodDate, $platformFeePercentage, $revenuePerStream);
            $results[] = [
                'collaboration_id' => $collaboration->id,
                'music_id' => $collaboration->music_id,
                'music_name' => $collaboration->music->name,
                'result' => $result,
            ];
        }

        return $results;
    }

    /**
     * Get distribution summary for a collaboration
     */
    public function getDistributionSummary($collaborationId, $startDate = null, $endDate = null)
    {
        $query = CollaborationRevenueDistribution::where('collaboration_id', $collaborationId);

        if ($startDate && $endDate) {
            $query->whereBetween('period_date', [$startDate, $endDate]);
        }

        return $query->selectRaw('
                artist_id,
                SUM(total_revenue) as total_revenue,
                SUM(platform_fee) as total_platform_fee,
                SUM(artist_share_after_split) as total_artist_share,
                SUM(stream_count) as total_streams,
                AVG(ownership_percentage) as avg_ownership_percentage
            ')
            ->groupBy('artist_id')
            ->with('artist')
            ->get();
    }
}
