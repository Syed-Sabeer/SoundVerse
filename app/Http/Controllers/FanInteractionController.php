<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ArtistQaSession;
use App\Models\QaQuestion;
use App\Models\ExclusivePreview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FanInteractionController extends Controller
{
    public function qaSessions(Request $request)
    {
        $query = ArtistQaSession::with('artist')
            ->where('is_active', true)
            ->where('status', '!=', 'cancelled');

        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        $sessions = $query->latest('scheduled_at')->paginate(20);

        return view('fan-interaction.qa-sessions', compact('sessions'));
    }

    public function viewQaSession($sessionId)
    {
        $session = ArtistQaSession::with(['artist', 'questions.user'])
            ->where('is_active', true)
            ->findOrFail($sessionId);

        // Check access
        $hasAccess = $this->checkAccess($session->access_type);

        if (!$hasAccess) {
            abort(403, 'You do not have access to this Q&A session.');
        }

        return view('fan-interaction.view-qa-session', compact('session'));
    }

    public function askQuestion(Request $request, $sessionId)
    {
        $session = ArtistQaSession::findOrFail($sessionId);

        $hasAccess = $this->checkAccess($session->access_type);

        if (!$hasAccess) {
            return back()->with('error', 'You do not have access to ask questions in this session.');
        }

        $validated = $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        QaQuestion::create([
            'qa_session_id' => $sessionId,
            'user_id' => Auth::id(),
            'question' => $validated['question'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Question submitted successfully!');
    }

    public function upvoteQuestion($questionId)
    {
        $question = QaQuestion::findOrFail($questionId);
        $question->increment('upvotes');

        return response()->json(['success' => true, 'upvotes' => $question->upvotes]);
    }

    public function previews(Request $request)
    {
        $query = ExclusivePreview::with('artist')
            ->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('expiry_date')
                  ->orWhere('expiry_date', '>=', now());
            });

        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        $previews = $query->latest('release_date')->paginate(20);

        return view('fan-interaction.previews', compact('previews'));
    }

    private function checkAccess($accessType)
    {
        $user = Auth::user();
        
        if (!$user) {
            return false;
        }

        switch ($accessType) {
            case 'public':
                return true;
            case 'all_subscribers':
                // Any paid subscription (Premium or Super)
                return $user->activeUserSubscription !== null;
            case 'premium_only':
                // Premium Listener or higher
                $subscription = $user->activeUserSubscription;
                if (!$subscription || !$subscription->subscriptionPlan) {
                    return false;
                }
                // Premium Listener (id 2) or Super Listener (id 3)
                return in_array($subscription->usersubscription_id, [2, 3]);
            case 'super_listeners_only':
                // Only Super Listener (id 3)
                $subscription = $user->activeUserSubscription;
                if (!$subscription || !$subscription->subscriptionPlan) {
                    return false;
                }
                return $subscription->usersubscription_id == 3;
            default:
                return false;
        }
    }
}
