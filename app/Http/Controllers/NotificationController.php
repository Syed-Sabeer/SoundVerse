<?php

namespace App\Http\Controllers;

use App\Models\NotificationPreference;
use App\Models\NotificationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function preferences()
    {
        $userId = Auth::id();
        $preferences = NotificationPreference::where('user_id', $userId)->get();

        return view('notifications.preferences', compact('preferences'));
    }

    public function updatePreferences(Request $request)
    {
        $userId = Auth::id();
        $eventTypes = [
            'payment_success',
            'payment_failed',
            'subscription_upcoming',
            'subscription_expired',
            'subscription_renewed',
            'low_balance',
            'earnings_available',
            'payout_processed',
            'payout_failed',
            'new_follower',
            'new_comment',
            'system_update',
        ];

        foreach ($eventTypes as $eventType) {
            NotificationPreference::updateOrCreate(
                [
                    'user_id' => $userId,
                    'event_type' => $eventType,
                ],
                [
                    'email_enabled' => $request->has("{$eventType}_email") ? 1 : 0,
                    'push_enabled' => $request->has("{$eventType}_push") ? 1 : 0,
                    'sms_enabled' => $request->has("{$eventType}_sms") ? 1 : 0,
                ]
            );
        }

        return back()->with('success', 'Notification preferences updated successfully.');
    }

    public function history(Request $request)
    {
        $userId = Auth::id();

        $query = NotificationLog::where('user_id', $userId);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $logs = $query->latest()->paginate(20);

        return view('notifications.history', compact('logs'));
    }
}
