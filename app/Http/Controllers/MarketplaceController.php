<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MarketplaceItem;
use App\Models\MarketplacePurchase;
use App\Models\MarketplaceReview;
use App\Models\CollaborationRequest;
use App\Models\UserCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $query = MarketplaceItem::with('artist')
            ->where('status', 'active');

        if ($request->filled('item_type')) {
            $query->where('item_type', $request->item_type);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                case 'popular':
                    $query->orderBy('purchase_count', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $items = $query->paginate(20);

        return view('marketplace.index', compact('items'));
    }

    public function show($id)
    {
        $item = MarketplaceItem::with(['artist', 'reviews.buyer'])
            ->findOrFail($id);

        $item->increment('view_count');

        return view('marketplace.show', compact('item'));
    }

    public function purchase(Request $request, $id)
    {
        $item = MarketplaceItem::findOrFail($id);
        $buyerId = Auth::id();

        if ($item->artist_id === $buyerId) {
            return back()->with('error', 'You cannot purchase your own item.');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:cash,credits,both',
        ]);

        $totalAmount = $item->price;
        $cashAmount = null;
        $creditsAmount = null;
        $credits = null;

        if ($validated['payment_method'] === 'credits' || $validated['payment_method'] === 'both') {
            $credits = UserCredit::where('user_id', $buyerId)->first();

            if ($validated['payment_method'] === 'credits') {
                $creditsAmount = $item->credits_price ?? $item->price;
                if (!$credits || $credits->balance < $creditsAmount) {
                    return back()->with('error', 'Insufficient credits.');
                }
            } else {
                // Both cash and credits
                $creditsAmount = $item->credits_price ?? 0;
                $cashAmount = $item->price - $creditsAmount;
                if ($creditsAmount > 0 && (!$credits || $credits->balance < $creditsAmount)) {
                    return back()->with('error', 'Insufficient credits.');
                }
            }
        } else {
            $cashAmount = $item->price;
        }

        // Calculate platform fee (10%)
        $platformFee = $totalAmount * 0.10;
        $artistEarnings = $totalAmount - $platformFee;

        // Create purchase record
        $purchase = MarketplacePurchase::create([
            'item_id' => $item->id,
            'buyer_id' => $buyerId,
            'seller_id' => $item->artist_id,
            'price' => $totalAmount,
            'payment_method' => $validated['payment_method'],
            'cash_amount' => $cashAmount,
            'credits_amount' => $creditsAmount,
            'platform_fee' => $platformFee,
            'artist_earnings' => $artistEarnings,
            'license_type' => $item->license_type,
            'download_url' => Storage::url($item->media_file),
            'download_expires_at' => now()->addDays(30),
            'status' => 'pending',
        ]);

        // Deduct credits if used
        if ($creditsAmount > 0 && $credits) {
            $credits->decrement('balance', $creditsAmount);
            $credits->increment('lifetime_spent', $creditsAmount);
        }

        // Process cash payment if needed
        if ($cashAmount > 0) {
            // Integrate with payment gateway
            // After successful payment:
            $purchase->update(['status' => 'completed', 'completed_at' => now()]);
        } else {
            $purchase->update(['status' => 'completed', 'completed_at' => now()]);
        }

        // Update item stats
        $item->increment('purchase_count');

        // Create earning record for artist
        \App\Models\ArtistEarning::create([
            'artist_id' => $item->artist_id,
            'earnings_type' => 'purchase',
            'gross_amount' => $totalAmount,
            'platform_fee' => $platformFee,
            'net_amount' => $artistEarnings,
            'status' => 'processed',
            'period_date' => now()->toDateString(),
            'processed_at' => now(),
        ]);

        // Notify artist about marketplace sale
        try {
            $artist = \App\Models\User::find($item->artist_id);
            if ($artist) {
                $message = "Your item \"{$item->title}\" was purchased! You earned $" . 
                    number_format($artistEarnings, 2) . " (after platform fee). Amount added to your wallet.";
                app('notificationService')->notifyUsers([$artist], $message, 'Marketplace Sale', 'payment');
            }
        } catch (\Throwable $e) {
            // Ignore notification failures
        }

        return redirect()->route('marketplace.purchase-confirmation', $purchase->id)
            ->with('success', 'Purchase completed successfully!');
    }

    public function purchaseConfirmation($id)
    {
        $purchase = MarketplacePurchase::where('buyer_id', Auth::id())
            ->with(['item', 'seller'])
            ->findOrFail($id);

        return view('marketplace.purchase-confirmation', compact('purchase'));
    }

    public function review(Request $request, $purchaseId)
    {
        $purchase = MarketplacePurchase::where('buyer_id', Auth::id())
            ->findOrFail($purchaseId);

        if ($purchase->review) {
            return back()->with('error', 'You have already reviewed this purchase.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        $review = MarketplaceReview::create([
            'item_id' => $purchase->item_id,
            'purchase_id' => $purchaseId,
            'buyer_id' => Auth::id(),
            'rating' => $validated['rating'],
            'review_text' => $validated['review_text'],
            'is_verified_purchase' => true,
            'status' => 'approved',
        ]);

        // Update item rating
        $item = MarketplaceItem::find($purchase->item_id);
        $item->increment('review_count');
        $reviews = MarketplaceReview::where('item_id', $item->id)->where('status', 'approved');
        $item->rating = $reviews->avg('rating');
        $item->save();

        return back()->with('success', 'Review submitted successfully!');
    }

    public function requestCollaboration(Request $request, $itemId)
    {
        $item = MarketplaceItem::findOrFail($itemId);

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'proposed_budget' => 'nullable|numeric|min:0',
        ]);

        CollaborationRequest::create([
            'item_id' => $itemId,
            'requester_id' => Auth::id(),
            'artist_id' => $item->artist_id,
            'message' => $validated['message'],
            'proposed_budget' => $validated['proposed_budget'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Collaboration request sent successfully!');
    }
}
