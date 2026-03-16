<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RoyaltyCalculationService;
use App\Models\PlatformRevenueTracking;
use Illuminate\Support\Facades\Log;

class CalculateMonthlyRoyalties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'royalties:calculate {month?} {year?} {--revenue=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate monthly royalties for all artists based on streams and platform revenue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $month = $this->argument('month') ?? now()->subMonth()->month;
        $year = $this->argument('year') ?? now()->subMonth()->year;
        $revenue = $this->option('revenue');

        $this->info("Calculating royalties for {$month}/{$year}...");

        // If revenue not provided, try to get from platform revenue tracking
        if ($revenue === null) {
            $platformRevenue = PlatformRevenueTracking::getForPeriod($month, $year);
            if ($platformRevenue && $platformRevenue->total_platform_revenue > 0) {
                $revenue = $platformRevenue->total_platform_revenue;
                $this->info("Using platform revenue from tracking: $" . number_format($revenue, 2));
            } else {
                // Prompt for revenue if not found
                $revenue = $this->ask('Enter total platform revenue for this period (USD)', 0);
            }
        }

        try {
            $royaltyService = new RoyaltyCalculationService();
            $calculations = $royaltyService->calculateRoyaltiesForPeriod($month, $year, (float)$revenue);

            $this->info("Royalty calculation completed!");
            $this->info("Total artists processed: " . count($calculations));
            
            foreach ($calculations as $calc) {
                $this->line("Artist ID {$calc['artist_id']}: {$calc['streams']} streams, $" . 
                    number_format($calc['net_amount'], 2) . " net earnings");
            }

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Error calculating royalties: " . $e->getMessage());
            Log::error("Royalty calculation command failed", [
                'month' => $month,
                'year' => $year,
                'error' => $e->getMessage(),
            ]);
            return Command::FAILURE;
        }
    }
}
