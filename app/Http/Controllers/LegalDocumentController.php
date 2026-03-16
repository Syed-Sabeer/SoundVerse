<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LegalDocument;
use App\Models\UserAgreement;
use App\Models\ArtistAgreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LegalDocumentController extends Controller
{
    public function index()
    {
        $documents = LegalDocument::where('is_active', true)
            ->latest('effective_date')
            ->get();

        $userId = Auth::id();
        $isArtist = Auth::user()->is_artist ?? false;

        // Get accepted agreements
        if ($isArtist) {
            $acceptedDocuments = ArtistAgreement::where('artist_id', $userId)
                ->pluck('document_id')
                ->toArray();
        } else {
            $acceptedDocuments = UserAgreement::where('user_id', $userId)
                ->pluck('document_id')
                ->toArray();
        }

        return view('legal-documents.index', compact('documents', 'acceptedDocuments', 'isArtist'));
    }

    public function show($slug)
    {
        $document = LegalDocument::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $userId = Auth::id();
        $isArtist = Auth::user()->is_artist ?? false;

        // Check if already accepted
        if ($isArtist) {
            $agreement = ArtistAgreement::where('artist_id', $userId)
                ->where('document_id', $document->id)
                ->first();
        } else {
            $agreement = UserAgreement::where('user_id', $userId)
                ->where('document_id', $document->id)
                ->first();
        }

        return view('legal-documents.show', compact('document', 'agreement', 'isArtist'));
    }

    public function accept(Request $request)
    {
        $request->validate([
            'document_id' => 'required|exists:legal_documents,id',
        ]);

        $document = LegalDocument::findOrFail($request->document_id);
        $userId = Auth::id();
        $isArtist = Auth::user()->is_artist ?? false;

        if ($isArtist) {
            ArtistAgreement::updateOrCreate(
                [
                    'artist_id' => $userId,
                    'document_id' => $document->id,
                ],
                [
                    'document_version' => $document->version,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'accepted_at' => now(),
                ]
            );
        } else {
            UserAgreement::updateOrCreate(
                [
                    'user_id' => $userId,
                    'document_id' => $document->id,
                ],
                [
                    'document_version' => $document->version,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'accepted_at' => now(),
                ]
            );
        }

        return back()->with('success', 'Document accepted successfully.');
    }
}
