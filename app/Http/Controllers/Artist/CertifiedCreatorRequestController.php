<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\CertifiedCreatorRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertifiedCreatorRequestController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if (!$user || !$user->is_artist) {
            return back()->with('error', 'Only artists can submit certified creator requests.');
        }

        $hasPendingRequest = CertifiedCreatorRequest::where('artist_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($hasPendingRequest) {
            return back()->with('error', 'You already have a pending certified creator request.');
        }

        $validated = $request->validate([
            'reason' => 'required|string|min:20|max:1000',
            'kyc_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'supporting_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $kycDocumentPath = $request->file('kyc_document')->store('certified_creator_requests/kyc', 'public');
        $supportingDocumentPath = $request->hasFile('supporting_document')
            ? $request->file('supporting_document')->store('certified_creator_requests/supporting', 'public')
            : null;

        $creatorRequest = CertifiedCreatorRequest::create([
            'artist_id' => $user->id,
            'reason' => $validated['reason'],
            'kyc_document_path' => $kycDocumentPath,
            'supporting_document_path' => $supportingDocumentPath,
            'status' => 'pending',
        ]);

        $admins = User::role('admin')->get();
        if ($admins->isNotEmpty()) {
            $actionUrl = route('admin.certified-creator-requests.show', $creatorRequest->id);
            $message = 'New Certified Creator request submitted by ' . ($user->name ?? $user->username ?? 'Artist') . '.';

            app('notificationService')->notifyUsers(
                $admins,
                $message,
                'Certified Creator Request',
                'system',
                $actionUrl,
                [
                    'request_id' => $creatorRequest->id,
                    'artist_id' => $user->id,
                ]
            );
        }

        return back()->with('success', 'Your Certified Creator request has been submitted for admin review.');
    }
}
