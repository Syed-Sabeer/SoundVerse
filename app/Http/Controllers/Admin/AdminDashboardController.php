<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ArtistMusic;
use App\Models\ArtistTip;
use App\Models\PayoutRequest;
use App\Models\RoyaltyCalculation;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\FAQQuestion;
use App\Models\ContactSubmission;
use App\Models\NewNewsletter;
use App\Models\VisitStat;
use App\Models\UserSubscription;
use App\Models\ArtistSubscription;
use App\Models\UserSubscriptionPlan;
use App\Models\ArtistSubscriptionPlan;
use App\Models\Ad;
use App\Models\ArtworkPhoto;
use App\Models\TrackCollaboration;
use App\Models\ArtistEarning;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // User & Artist Analytics
        $totalArtists = User::where('is_artist', true)->orWhereHas('roles', function($q) {
            $q->where('name', 'artist');
        })->count();
        $featuredArtists = User::where('is_featured', true)->where('is_artist', true)->count();
        $activeArtists = User::where('is_artist', true)->where('is_active', true)->count();
        
        $totalCustomers = User::where('is_artist', false)->whereDoesntHave('roles', function($q) {
            $q->where('name', 'admin');
        })->count();
        $activeCustomers = User::where('is_artist', false)->where('is_active', true)->whereDoesntHave('roles', function($q) {
            $q->where('name', 'admin');
        })->count();
        
        // Music & Content Analytics
        $totalSongs = ArtistMusic::count();
        $featuredSongs = ArtistMusic::where('is_featured', true)->count();
        $totalArtworks = ArtworkPhoto::count();
        
        // Royalty & Financial Analytics
        $totalRoyaltyEarnings = RoyaltyCalculation::sum('artist_royalty_amount') ?? 0;
        $pendingPayouts = PayoutRequest::where('status', 'pending')->count();
        $completedPayouts = PayoutRequest::where('status', 'completed')->count();
        $totalPayoutAmount = PayoutRequest::where('status', 'completed')->sum('requested_amount') ?? 0;
        
        // Tips Analytics
        $totalTips = ArtistTip::count();
        $pendingTips = ArtistTip::where('status', 'pending')->count();
        $completedTips = ArtistTip::where('status', 'sent_to_artist')->count();
        $totalTipAmount = ArtistTip::sum('amount') ?? 0;
        
        // Content Management Analytics
        $totalBlogs = Blog::count();
        $publishedBlogs = Blog::where('visibility', 1)->count();
        $totalFaqs = Faq::count();
        $publishedFaqs = Faq::where('visibility', 1)->count();
        $totalFaqQuestions = FAQQuestion::where('is_active', true)->count();
        
        // Submissions & Engagement
        $totalContacts = ContactSubmission::count();
        $newsletterSubscriptions = NewNewsletter::count();
        $totalVisits = VisitStat::first()?->home_visits ?? 0;
        
        // Subscription Analytics
        $activeUserSubscriptions = UserSubscription::get()->filter(function($subscription) {
            return $subscription->isActive();
        })->count();
        $activeArtistSubscriptions = ArtistSubscription::get()->filter(function($subscription) {
            return $subscription->isActive();
        })->count();
        $totalUserPlans = UserSubscriptionPlan::count();
        $totalArtistPlans = ArtistSubscriptionPlan::count();
        
        // Additional Features
        $totalAds = Ad::count();
        $activeAds = Ad::where('visibility', 1)->count();
        $totalCollaborations = TrackCollaboration::count();
        $pendingCollaborations = TrackCollaboration::where('status', 'pending')->count();
        
        // Recent Activity (last 30 days)
        $recentArtists = User::where('is_artist', true)
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        $recentSongs = ArtistMusic::where('created_at', '>=', now()->subDays(30))->count();
        $recentUsers = User::where('is_artist', false)
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        
        // Chart Data - Monthly Revenue Trend (Last 6 months)
        $monthlyRevenue = [];
        $monthlyLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();
            
            $revenue = RoyaltyCalculation::whereBetween('calculation_period', [$monthStart, $monthEnd])
                ->sum('artist_royalty_amount') ?? 0;
            
            $monthlyRevenue[] = round($revenue, 2);
            $monthlyLabels[] = $date->format('M Y');
        }
        
        // Chart Data - User Growth (Last 6 months)
        $monthlyUsers = [];
        $monthlyArtists = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();
            
            $users = User::where('is_artist', false)
                ->whereDoesntHave('roles', function($q) {
                    $q->where('name', 'admin');
                })
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
            
            $artists = User::where('is_artist', true)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
            
            $monthlyUsers[] = $users;
            $monthlyArtists[] = $artists;
        }
        
        // Chart Data - Payout Status Breakdown
        $payoutStatusData = [
            PayoutRequest::where('status', 'pending')->count(),
            PayoutRequest::where('status', 'processing')->count(),
            PayoutRequest::where('status', 'completed')->count(),
            PayoutRequest::where('status', 'rejected')->count(),
        ];
        
        // Chart Data - Tips Status Breakdown
        $tipsStatusData = [
            ArtistTip::where('status', 'pending')->count(),
            ArtistTip::where('status', 'paid')->count(),
            ArtistTip::where('status', 'sent_to_artist')->count(),
        ];
        
        // Chart Data - Song Uploads Trend (Last 6 months)
        $monthlySongs = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();
            
            $songs = ArtistMusic::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $monthlySongs[] = $songs;
        }
        
        return view('admin.dashboard', compact(
            'totalArtists', 'featuredArtists', 'activeArtists',
            'totalCustomers', 'activeCustomers',
            'totalSongs', 'featuredSongs', 'totalArtworks',
            'totalRoyaltyEarnings', 'pendingPayouts', 'completedPayouts', 'totalPayoutAmount',
            'totalTips', 'pendingTips', 'completedTips', 'totalTipAmount',
            'totalBlogs', 'publishedBlogs', 'totalFaqs', 'publishedFaqs', 'totalFaqQuestions',
            'totalContacts', 'newsletterSubscriptions', 'totalVisits',
            'activeUserSubscriptions', 'activeArtistSubscriptions', 'totalUserPlans', 'totalArtistPlans',
            'totalAds', 'activeAds', 'totalCollaborations', 'pendingCollaborations',
            'recentArtists', 'recentSongs', 'recentUsers',
            'monthlyRevenue', 'monthlyLabels', 'monthlyUsers', 'monthlyArtists',
            'payoutStatusData', 'tipsStatusData', 'monthlySongs'
        ));
    }
}
