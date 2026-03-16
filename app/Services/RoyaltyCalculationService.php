<?php

namespace App\Services;

use App\Models\ArtistMusic;
use App\Models\ArtistEarning;
use App\Models\ArtistWallet;
use App\Models\PlatformRevenueTracking;
use App\Models\RoyaltyCalculation;
use App\Models\StreamStat;
use App\Models\DownloadStat;
use App\Models\TrackCollaboration;
use App\Models\OwnershipSplit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoyaltyCalculationService
{
    /**
     * Platform fee percentage (20% as per example)
     */
    private $platformFeePercentage = 20.0;

    /**
     * Calculate royalties for a specific period
     * 
     * Formula: Artist's share = (artist_streams / total_platform_streams) × platform_revenue
     * Platform fee = 20% of gross
     * Net = Gross - Platform fee
     */
    public function calculateRoyaltiesForPeriod($month, $year, $platformRevenue = null)
    {
        try {
            DB::beginTransaction();

            // Get or create platform revenue tracking for the period
            $platformRevenueTracking = PlatformRevenueTracking::getForPeriod($month, $year);
            
            if (!$platformRevenueTracking) {
                // If no tracking exists, create it
                $platformRevenueTracking = PlatformRevenueTracking::create([
                    'period_month' => $month,
                    'period_year' => $year,
                    'total_platform_revenue' => $platformRevenue ?? 0,
                    'total_platform_streams' => 0,
                    'total_platform_downloads' => 0,
                    'status' => 'pending',
                ]);
            }

            // If platform revenue is provided, update it
            if ($platformRevenue !== null) {
                $platformRevenueTracking->total_platform_revenue = $platformRevenue;
            }

            // Calculate total platform streams for the period
            $startDate = \Carbon\Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = \Carbon\Carbon::create($year, $month, 1)->endOfMonth();

            $totalPlatformStreams = StreamStat::whereBetween('streamed_at', [$startDate, $endDate])
                ->where('is_complete', true)
                ->count();

            $totalPlatformDownloads = DownloadStat::whereBetween('downloaded_at', [$startDate, $endDate])
                ->count();

            // Update platform revenue tracking
            $platformRevenueTracking->total_platform_streams = $totalPlatformStreams;
            $platformRevenueTracking->total_platform_downloads = $totalPlatformDownloads;
            $platformRevenueTracking->save();

            if ($totalPlatformStreams == 0 || $platformRevenueTracking->total_platform_revenue == 0) {
                Log::info("RoyaltyCalculation: No streams or revenue for period {$month}/{$year}");
                DB::commit();
                return [];
            }

            // Calculate per-track earnings first
            // Get all tracks with streams in this period
            $tracksWithStreams = StreamStat::whereBetween('streamed_at', [$startDate, $endDate])
                ->where('is_complete', true)
                ->select('music_id', DB::raw('COUNT(*) as stream_count'))
                ->groupBy('music_id')
                ->get();

            // Track earnings per artist for summary
            $artistEarningsSummary = [];
            $processedTracks = [];

            foreach ($tracksWithStreams as $trackStream) {
                $musicId = $trackStream->music_id;
                $trackStreams = $trackStream->stream_count;
                
                // Load the track with its collaboration
                $track = ArtistMusic::with('collaboration.ownershipSplits')->find($musicId);
                if (!$track) continue;

                // Calculate this track's gross revenue
                // Formula: (track_streams / total_platform_streams) × platform_revenue
                $trackGrossRevenue = ($trackStreams / $totalPlatformStreams) * $platformRevenueTracking->total_platform_revenue;
                $trackPlatformFee = $trackGrossRevenue * ($this->platformFeePercentage / 100);
                $trackNetAmount = $trackGrossRevenue - $trackPlatformFee;

                // Check if track is collaborative
                $collaboration = $track->collaboration;
                
                if ($collaboration && $collaboration->ownershipSplits->count() > 0) {
                    // Collaborative track - distribute based on ownership splits
                    $ownershipSplits = $collaboration->ownershipSplits;
                    $totalOwnership = $ownershipSplits->sum('ownership_percentage');

                    foreach ($ownershipSplits as $split) {
                        if ($totalOwnership == 0) continue;

                        $splitPercentage = $split->ownership_percentage / $totalOwnership;
                        $splitGross = $trackGrossRevenue * $splitPercentage;
                        $splitPlatformFee = $splitGross * ($this->platformFeePercentage / 100);
                        $splitNet = $splitGross - $splitPlatformFee;

                        // Create earnings for this collaborator
                        ArtistEarning::create([
                            'artist_id' => $split->artist_id,
                            'music_id' => $musicId,
                            'earnings_type' => 'stream',
                            'gross_amount' => $splitGross,
                            'platform_fee' => $splitPlatformFee,
                            'net_amount' => $splitNet,
                            'currency' => $platformRevenueTracking->currency,
                            'royalty_percentage' => 100 - $this->platformFeePercentage,
                            'status' => 'processed',
                            'period_date' => $startDate->format('Y-m-d'),
                            'processed_at' => now(),
                        ]);

                        // Update collaborator's wallet
                        $wallet = ArtistWallet::getOrCreateForArtist($split->artist_id);
                        $wallet->addEarnings($splitNet, 'available');

                        // Add to summary
                        if (!isset($artistEarningsSummary[$split->artist_id])) {
                            $artistEarningsSummary[$split->artist_id] = [
                                'streams' => 0,
                                'gross' => 0,
                                'platform_fee' => 0,
                                'net' => 0,
                            ];
                        }
                        $artistEarningsSummary[$split->artist_id]['streams'] += $trackStreams;
                        $artistEarningsSummary[$split->artist_id]['gross'] += $splitGross;
                        $artistEarningsSummary[$split->artist_id]['platform_fee'] += $splitPlatformFee;
                        $artistEarningsSummary[$split->artist_id]['net'] += $splitNet;
                    }
                } else {
                    // Non-collaborative track - 100% to track owner
                    $artistId = $track->driver_id;

                    ArtistEarning::create([
                        'artist_id' => $artistId,
                        'music_id' => $musicId,
                        'earnings_type' => 'stream',
                        'gross_amount' => $trackGrossRevenue,
                        'platform_fee' => $trackPlatformFee,
                        'net_amount' => $trackNetAmount,
                        'currency' => $platformRevenueTracking->currency,
                        'royalty_percentage' => 100 - $this->platformFeePercentage,
                        'status' => 'processed',
                        'period_date' => $startDate->format('Y-m-d'),
                        'processed_at' => now(),
                    ]);

                    // Update artist wallet
                    $wallet = ArtistWallet::getOrCreateForArtist($artistId);
                    $wallet->addEarnings($trackNetAmount, 'available');

                    // Add to summary
                    if (!isset($artistEarningsSummary[$artistId])) {
                        $artistEarningsSummary[$artistId] = [
                            'streams' => 0,
                            'gross' => 0,
                            'platform_fee' => 0,
                            'net' => 0,
                        ];
                    }
                    $artistEarningsSummary[$artistId]['streams'] += $trackStreams;
                    $artistEarningsSummary[$artistId]['gross'] += $trackGrossRevenue;
                    $artistEarningsSummary[$artistId]['platform_fee'] += $trackPlatformFee;
                    $artistEarningsSummary[$artistId]['net'] += $trackNetAmount;
                }

                $processedTracks[] = $musicId;
            }

            // Create royalty calculation summaries for each artist
            $calculations = [];
            foreach ($artistEarningsSummary as $artistId => $summary) {
                $royaltyCalculation = RoyaltyCalculation::updateOrCreate(
                    [
                        'artist_id' => $artistId,
                        'calculation_period' => $startDate->format('Y-m-d'),
                    ],
                    [
                        'total_streams' => $summary['streams'],
                        'total_downloads' => DownloadStat::where('artist_id', $artistId)
                            ->whereBetween('downloaded_at', [$startDate, $endDate])
                            ->count(),
                        'total_gross_revenue' => $summary['gross'],
                        'platform_fee_amount' => $summary['platform_fee'],
                        'artist_royalty_amount' => $summary['net'],
                        'royalty_percentage' => 100 - $this->platformFeePercentage,
                        'platform_fee_percentage' => $this->platformFeePercentage,
                        'status' => 'calculated',
                        'calculated_at' => now(),
                    ]
                );

                $calculations[] = [
                    'artist_id' => $artistId,
                    'streams' => $summary['streams'],
                    'gross_revenue' => $summary['gross'],
                    'platform_fee' => $summary['platform_fee'],
                    'net_amount' => $summary['net'],
                ];
            }

            // Finalize platform revenue tracking
            $platformRevenueTracking->status = 'finalized';
            $platformRevenueTracking->finalized_at = now();
            $platformRevenueTracking->save();

            DB::commit();

            // Notify artists about their royalty calculations
            try {
                foreach ($calculations as $calc) {
                    $artist = User::find($calc['artist_id']);
                    if ($artist && $calc['net_amount'] > 0) {
                        $periodName = \Carbon\Carbon::create($year, $month, 1)->format('F Y');
                        $message = "Royalty calculation completed for {$periodName}. You earned $" . 
                            number_format($calc['net_amount'], 2) . " from " . 
                            number_format($calc['streams']) . " streams. Amount added to your wallet.";
                        app('notificationService')->notifyUsers([$artist], $message, 'Royalty Calculated', 'payment');
                    }
                }
            } catch (\Throwable $e) {
                Log::warning("RoyaltyCalculation: Failed to send notifications", ['error' => $e->getMessage()]);
            }

            Log::info("RoyaltyCalculation: Completed for period {$month}/{$year}", [
                'total_artists' => count($calculations),
                'total_revenue' => $platformRevenueTracking->total_platform_revenue,
                'total_streams' => $totalPlatformStreams,
            ]);

            return $calculations;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("RoyaltyCalculation: Error calculating royalties", [
                'month' => $month,
                'year' => $year,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }


    /**
     * Calculate per-track earnings breakdown for an artist
     * Returns earnings for tracks where the artist is involved (owner or collaborator)
     */
    public function calculatePerTrackEarnings($artistId, $month, $year)
    {
        $startDate = \Carbon\Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::create($year, $month, 1)->endOfMonth();

        $platformRevenueTracking = PlatformRevenueTracking::getForPeriod($month, $year);
        if (!$platformRevenueTracking || $platformRevenueTracking->total_platform_streams == 0) {
            return [];
        }

        $totalPlatformStreams = $platformRevenueTracking->total_platform_streams;
        $totalPlatformRevenue = $platformRevenueTracking->total_platform_revenue;

        // Get tracks where artist is owner
        $ownedTracks = ArtistMusic::where('driver_id', $artistId)
            ->with('collaboration.ownershipSplits')
            ->get();

        // Get tracks where artist is a collaborator
        $collaboratedTracks = ArtistMusic::whereHas('collaboration.ownershipSplits', function($query) use ($artistId) {
            $query->where('artist_id', $artistId);
        })
        ->with('collaboration.ownershipSplits')
        ->get();

        // Merge and get unique tracks
        $allTracks = $ownedTracks->merge($collaboratedTracks)->unique('id');

        $trackEarnings = [];

        foreach ($allTracks as $track) {
            $trackStreams = StreamStat::where('music_id', $track->id)
                ->whereBetween('streamed_at', [$startDate, $endDate])
                ->where('is_complete', true)
                ->count();

            if ($trackStreams == 0) continue;

            // Calculate track's gross revenue
            $trackGross = ($trackStreams / $totalPlatformStreams) * $totalPlatformRevenue;
            $trackPlatformFee = $trackGross * ($this->platformFeePercentage / 100);
            $trackNet = $trackGross - $trackPlatformFee;

            // If collaborative, calculate artist's share
            $collaboration = $track->collaboration;
            if ($collaboration && $collaboration->ownershipSplits->count() > 0) {
                $artistSplit = $collaboration->ownershipSplits->where('artist_id', $artistId)->first();
                if ($artistSplit) {
                    $totalOwnership = $collaboration->ownershipSplits->sum('ownership_percentage');
                    $artistPercentage = $artistSplit->ownership_percentage / $totalOwnership;
                    $trackGross = $trackGross * $artistPercentage;
                    $trackPlatformFee = $trackGross * ($this->platformFeePercentage / 100);
                    $trackNet = $trackGross - $trackPlatformFee;
                } else {
                    // Artist not in splits, skip
                    continue;
                }
            }

            $trackEarnings[] = [
                'track_id' => $track->id,
                'track_name' => $track->name,
                'streams' => $trackStreams,
                'gross_revenue' => $trackGross,
                'platform_fee' => $trackPlatformFee,
                'net_amount' => $trackNet,
            ];
        }

        return $trackEarnings;
    }

    /**
     * Set platform fee percentage
     */
    public function setPlatformFeePercentage($percentage)
    {
        $this->platformFeePercentage = $percentage;
    }
}
