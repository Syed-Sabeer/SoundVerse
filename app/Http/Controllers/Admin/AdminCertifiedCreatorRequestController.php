<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CertifiedCreatorRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCertifiedCreatorRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = CertifiedCreatorRequest::with(['artist', 'reviewer'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('artist', function ($artistQuery) use ($search) {
                $artistQuery->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $requests = $query->paginate(20)->withQueryString();

        return view('admin.certified-creator-requests.index', compact('requests'));
    }

    public function show(int $id)
    {
        $creatorRequest = CertifiedCreatorRequest::with(['artist', 'reviewer'])->findOrFail($id);

        return view('admin.certified-creator-requests.show', compact('creatorRequest'));
    }

    public function approve(Request $request, int $id): RedirectResponse
    {
        $creatorRequest = CertifiedCreatorRequest::with('artist')->findOrFail($id);

        if ($creatorRequest->status !== 'pending') {
            return back()->with('error', 'This request has already been reviewed.');
        }

        $creatorRequest->update([
            'status' => 'approved',
            'admin_notes' => $request->input('admin_notes'),
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        $artist = $creatorRequest->artist;
        $artist->is_certified_creator = true;
        $artist->save();

        app('notificationService')->notifyUsers(
            [$artist],
            'Your Certified Creator request has been approved.',
            'Certified Creator Approved',
            'system',
            route('artist.portal'),
            ['request_id' => $creatorRequest->id]
        );

        return redirect()->route('admin.certified-creator-requests.index')
            ->with('success', 'Certified Creator request approved successfully.');
    }

    public function reject(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        $creatorRequest = CertifiedCreatorRequest::with('artist')->findOrFail($id);

        if ($creatorRequest->status !== 'pending') {
            return back()->with('error', 'This request has already been reviewed.');
        }

        $creatorRequest->update([
            'status' => 'rejected',
            'admin_notes' => $validated['admin_notes'],
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        $artist = $creatorRequest->artist;
        $artist->is_certified_creator = false;
        $artist->save();

        app('notificationService')->notifyUsers(
            [$artist],
            'Your Certified Creator request was rejected. Please review admin notes and resubmit.',
            'Certified Creator Rejected',
            'system',
            route('artist.portal'),
            ['request_id' => $creatorRequest->id]
        );

        return redirect()->route('admin.certified-creator-requests.index')
            ->with('success', 'Certified Creator request rejected.');
    }
}
