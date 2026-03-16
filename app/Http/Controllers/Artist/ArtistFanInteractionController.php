<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\ArtistQaSession;
use App\Models\QaQuestion;
use App\Models\ExclusivePreview;
use App\Models\PreviewAccessLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtistFanInteractionController extends Controller
{
    // Q&A Sessions
    public function qaSessions()
    {
        $artistId = Auth::id();
        $sessions = ArtistQaSession::where('artist_id', $artistId)
            ->latest('scheduled_at')
            ->paginate(20);

        return view('artist.fan-interaction.qa-sessions', compact('sessions'));
    }

    public function createQaSession()
    {
        return view('artist.fan-interaction.create-qa-session');
    }

    public function storeQaSession(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'access_type' => 'required|in:premium_only,super_listeners_only,all_subscribers,public',
            'scheduled_at' => 'nullable|date',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        ArtistQaSession::create([
            'artist_id' => Auth::id(),
            ...$validated,
            'status' => 'scheduled',
        ]);

        return redirect()->route('artist.qa-sessions')
            ->with('success', 'Q&A session created successfully!');
    }

    public function questions($sessionId)
    {
        $session = ArtistQaSession::where('artist_id', Auth::id())
            ->findOrFail($sessionId);

        $questions = QaQuestion::where('qa_session_id', $sessionId)
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('artist.fan-interaction.questions', compact('session', 'questions'));
    }

    public function answerQuestion(Request $request, $questionId)
    {
        $question = QaQuestion::whereHas('qaSession', function($query) {
            $query->where('artist_id', Auth::id());
        })->findOrFail($questionId);

        $question->update([
            'answer' => $request->answer,
            'answered_at' => now(),
            'status' => 'answered',
        ]);

        return back()->with('success', 'Question answered successfully!');
    }

    // Exclusive Previews
    public function previews()
    {
        $artistId = Auth::id();
        $previews = ExclusivePreview::where('artist_id', $artistId)
            ->latest('release_date')
            ->paginate(20);

        return view('artist.fan-interaction.previews', compact('previews'));
    }

    public function createPreview()
    {
        $musics = \App\Models\ArtistMusic::where('driver_id', Auth::id())->get();
        return view('artist.fan-interaction.create-preview', compact('musics'));
    }

    public function storePreview(Request $request)
    {
        $validated = $request->validate([
            'music_id' => 'nullable|exists:artist_musics,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'preview_type' => 'required|in:audio,video,behind_scenes,story,other',
            'access_type' => 'required|in:premium_only,super_listeners_only,all_subscribers,public',
            'release_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after:release_date',
            'media_file' => 'required|file|mimes:mp3,mp4,avi,mov|max:50000',
            'thumbnail_image' => 'nullable|image|max:5120',
        ]);

        $mediaPath = $request->file('media_file')->store('exclusive_previews', 'public');
        $thumbnailPath = $request->hasFile('thumbnail_image')
            ? $request->file('thumbnail_image')->store('exclusive_previews/thumbnails', 'public')
            : null;

        ExclusivePreview::create([
            'artist_id' => Auth::id(),
            'music_id' => $validated['music_id'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'preview_type' => $validated['preview_type'],
            'access_type' => $validated['access_type'],
            'media_url' => $mediaPath,
            'thumbnail_url' => $thumbnailPath,
            'release_date' => $validated['release_date'] ?? now(),
            'expiry_date' => $validated['expiry_date'],
            'is_active' => true,
        ]);

        return redirect()->route('artist.previews')
            ->with('success', 'Exclusive preview created successfully!');
    }

    public function viewPreview($previewId)
    {
        $preview = ExclusivePreview::findOrFail($previewId);

        // Check access
        $user = Auth::user();
        $hasAccess = false;

        if ($preview->access_type === 'public') {
            $hasAccess = true;
        } elseif ($preview->access_type === 'all_subscribers' && $user && $user->activeUserSubscription) {
            $hasAccess = true;
        } elseif ($preview->access_type === 'premium_only' && $user) {
            // Check if user has Premium or Super Listener subscription
            $subscription = $user->activeUserSubscription;
            if ($subscription && $subscription->subscriptionPlan) {
                $hasAccess = in_array($subscription->usersubscription_id, [2, 3]); // Premium (2) or Super (3)
            }
        } elseif ($preview->access_type === 'super_listeners_only' && $user) {
            // Only Super Listener (id 3)
            $subscription = $user->activeUserSubscription;
            if ($subscription && $subscription->subscriptionPlan) {
                $hasAccess = $subscription->usersubscription_id == 3;
            }
        }

        if (!$hasAccess) {
            abort(403, 'You do not have access to this preview.');
        }

        // Log access
        PreviewAccessLog::create([
            'preview_id' => $previewId,
            'user_id' => Auth::id(),
            'accessed_at' => now(),
        ]);

        $preview->increment('view_count');

        return view('artist.fan-interaction.view-preview', compact('preview'));
    }
}
