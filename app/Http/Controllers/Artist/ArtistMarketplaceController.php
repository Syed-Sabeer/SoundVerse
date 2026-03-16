<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\MarketplaceItem;
use App\Models\MarketplacePurchase;
use App\Models\MarketplaceReview;
use App\Models\CollaborationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtistMarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $artistId = Auth::id();

        $query = MarketplaceItem::where('artist_id', $artistId);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('item_type')) {
            $query->where('item_type', $request->item_type);
        }

        $items = $query->latest()->paginate(20);

        // Statistics
        $totalItems = MarketplaceItem::where('artist_id', $artistId)->count();
        $totalSales = MarketplacePurchase::where('seller_id', $artistId)
            ->where('status', 'completed')
            ->count();
        $totalEarnings = MarketplacePurchase::where('seller_id', $artistId)
            ->where('status', 'completed')
            ->sum('artist_earnings');

        return view('artist.marketplace.index', compact('items', 'totalItems', 'totalSales', 'totalEarnings'));
    }

    public function create()
    {
        return view('artist.marketplace.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_type' => 'required|in:beat,collaboration,personalized_music,instrumental,acapella,other',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'price_currency' => 'required|string|max:3',
            'accept_credits' => 'boolean',
            'credits_price' => 'nullable|numeric|min:0|required_if:accept_credits,1',
            'media_file' => 'required|file|mimes:mp3,wav,flac|max:50000',
            'thumbnail_image' => 'nullable|image|max:5120',
            'demo_file' => 'nullable|file|mimes:mp3,wav|max:10000',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'license_type' => 'required|in:exclusive,non_exclusive,lease,unlimited',
        ]);

        $mediaPath = $request->file('media_file')->store('marketplace_items', 'public');
        $thumbnailPath = $request->hasFile('thumbnail_image')
            ? $request->file('thumbnail_image')->store('marketplace_items/thumbnails', 'public')
            : null;
        $demoPath = $request->hasFile('demo_file')
            ? $request->file('demo_file')->store('marketplace_items/demos', 'public')
            : null;

        MarketplaceItem::create([
            'artist_id' => Auth::id(),
            'item_type' => $validated['item_type'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'price_currency' => $validated['price_currency'],
            'accept_credits' => $request->has('accept_credits') ? 1 : 0,
            'credits_price' => $validated['credits_price'] ?? null,
            'media_file' => $mediaPath,
            'thumbnail_image' => $thumbnailPath,
            'demo_file' => $demoPath,
            'category' => $validated['category'],
            'tags' => $validated['tags'] ? explode(',', $validated['tags']) : null,
            'license_type' => $validated['license_type'],
            'status' => 'active',
        ]);

        return redirect()->route('artist.marketplace.index')
            ->with('success', 'Item listed successfully!');
    }

    public function edit($id)
    {
        $item = MarketplaceItem::where('artist_id', Auth::id())->findOrFail($id);
        return view('artist.marketplace.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = MarketplaceItem::where('artist_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'accept_credits' => 'boolean',
            'credits_price' => 'nullable|numeric|min:0',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,active,sold_out,archived',
        ]);

        if ($request->hasFile('thumbnail_image')) {
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('marketplace_items/thumbnails', 'public');
        }

        $validated['accept_credits'] = $request->has('accept_credits') ? 1 : 0;
        if ($validated['tags']) {
            $validated['tags'] = explode(',', $validated['tags']);
        }

        $item->update($validated);

        return redirect()->route('artist.marketplace.index')
            ->with('success', 'Item updated successfully!');
    }

    public function sales()
    {
        $artistId = Auth::id();

        $sales = MarketplacePurchase::where('seller_id', $artistId)
            ->with(['buyer', 'item'])
            ->latest('purchased_at')
            ->paginate(20);

        return view('artist.marketplace.sales', compact('sales'));
    }

    public function collaborationRequests()
    {
        $artistId = Auth::id();

        $requests = CollaborationRequest::where('artist_id', $artistId)
            ->with(['requester', 'item'])
            ->latest()
            ->paginate(20);

        return view('artist.marketplace.collaboration-requests', compact('requests'));
    }

    public function respondToCollaboration(Request $request, $id)
    {
        $collabRequest = CollaborationRequest::where('artist_id', Auth::id())
            ->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
            'message' => 'nullable|string',
        ]);

        $collabRequest->update([
            'status' => $validated['status'],
            'responded_at' => now(),
        ]);

        return back()->with('success', 'Collaboration request ' . $validated['status'] . ' successfully.');
    }
}
