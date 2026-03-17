<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionExpiryMail;
use App\Models\ArtistSubscription;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionExpiryReminders extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'subscriptions:send-expiry-reminders
                            {--days=3 : How many days before expiry to send the reminder}
                            {--dry-run : List who would be emailed without actually sending}';

    /**
     * The console command description.
     */
    protected $description = 'Send email reminders to users and artists whose subscription expires in N days (default 3)';

    public function handle(): int
    {
        $daysAhead = (int) $this->option('days');
        $dryRun    = $this->option('dry-run');

        // Target window: plans whose end date falls within tomorrow's midnight to the end
        // of the day that is $daysAhead from now.
        // e.g. if today is 17 Mar and daysAhead=3, we target plans expiring on 20 Mar (all day).
        $targetDate = Carbon::today()->addDays($daysAhead);
        $windowStart = $targetDate->copy()->startOfDay();
        $windowEnd   = $targetDate->copy()->endOfDay();

        $this->info("Checking subscriptions expiring between {$windowStart} and {$windowEnd}...");

        $sent  = 0;
        $skipped = 0;

        // ── 1. USER SUBSCRIPTIONS ────────────────────────────────────────────────
        $userSubs = UserSubscription::with(['user', 'subscriptionPlan'])->get();

        foreach ($userSubs as $sub) {
            if (!$sub->user || !$sub->user->email) {
                continue;
            }

            $endDate = $this->getUserSubEndDate($sub);
            if (!$endDate) {
                continue;
            }

            // Only send if the end date falls in today's target window
            if ($endDate->between($windowStart, $windowEnd)) {
                $planName = optional($sub->subscriptionPlan)->name ?? 'Subscription Plan';

                if ($dryRun) {
                    $this->line("[DRY RUN] Would email user: {$sub->user->email} | Plan: {$planName} | Expires: {$endDate->format('M d, Y')}");
                } else {
                    try {
                        Mail::to($sub->user->email)->send(new SubscriptionExpiryMail(
                            $sub->user->name ?? $sub->user->username ?? 'Valued User',
                            $planName,
                            $endDate->format('F d, Y'),
                            $daysAhead,
                            false // not artist
                        ));
                        $this->info("✓ Emailed user: {$sub->user->email}");
                        $sent++;
                    } catch (\Throwable $e) {
                        Log::error('SubscriptionExpiryReminder: Failed to email user', [
                            'user_id' => $sub->user_id,
                            'email'   => $sub->user->email,
                            'error'   => $e->getMessage(),
                        ]);
                        $this->error("✗ Failed: {$sub->user->email} – {$e->getMessage()}");
                        $skipped++;
                    }
                }
                $sent++;
            }
        }

        // ── 2. ARTIST SUBSCRIPTIONS ──────────────────────────────────────────────
        $artistSubs = ArtistSubscription::with(['user', 'subscriptionPlan'])->get();

        foreach ($artistSubs as $sub) {
            if (!$sub->user || !$sub->user->email) {
                continue;
            }

            $endDate = $this->getArtistSubEndDate($sub);
            if (!$endDate) {
                continue;
            }

            if ($endDate->between($windowStart, $windowEnd)) {
                $planName = optional($sub->subscriptionPlan)->name ?? 'Artist Subscription Plan';

                if ($dryRun) {
                    $this->line("[DRY RUN] Would email artist: {$sub->user->email} | Plan: {$planName} | Expires: {$endDate->format('M d, Y')}");
                } else {
                    try {
                        Mail::to($sub->user->email)->send(new SubscriptionExpiryMail(
                            $sub->user->name ?? $sub->user->username ?? 'Valued Artist',
                            $planName,
                            $endDate->format('F d, Y'),
                            $daysAhead,
                            true // is artist
                        ));
                        $this->info("✓ Emailed artist: {$sub->user->email}");
                        $sent++;
                    } catch (\Throwable $e) {
                        Log::error('SubscriptionExpiryReminder: Failed to email artist', [
                            'user_id' => $sub->user_id,
                            'email'   => $sub->user->email,
                            'error'   => $e->getMessage(),
                        ]);
                        $this->error("✗ Failed: {$sub->user->email} – {$e->getMessage()}");
                        $skipped++;
                    }
                }
            }
        }

        if ($dryRun) {
            $this->info('Dry-run complete. No emails were actually sent.');
        } else {
            $this->info("Done. Sent: {$sent} | Skipped/Failed: {$skipped}");
            Log::info("SubscriptionExpiryReminders sent={$sent} skipped={$skipped} target_date={$targetDate->toDateString()}");
        }

        return self::SUCCESS;
    }

    /**
     * Calculate end date for a user subscription.
     * start_date (usersubscription_date) + duration (days)
     */
    private function getUserSubEndDate(UserSubscription $sub): ?Carbon
    {
        if (!$sub->usersubscription_date || !$sub->usersubscription_duration) {
            return null;
        }

        return Carbon::parse($sub->usersubscription_date)->addDays($sub->usersubscription_duration);
    }

    /**
     * Calculate end date for an artist subscription.
     * start_date (subscription_date) + duration (days)
     */
    private function getArtistSubEndDate(ArtistSubscription $sub): ?Carbon
    {
        if (!$sub->subscription_date || !$sub->subscription_duration) {
            return null;
        }

        return Carbon::parse($sub->subscription_date)->addDays($sub->subscription_duration);
    }
}
