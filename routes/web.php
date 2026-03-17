<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminFAQQuestionController;
use App\Http\Controllers\Admin\AdminChatbotController;
use App\Http\Controllers\Admin\AdminPartnerController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminTetherWorkController;
// use App\Http\Controllers\Admin\AdminSocialShareMusicController;
// use App\Http\Controllers\Admin\AdminWellnessController;
use App\Http\Controllers\Admin\AdminLiveVideoController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminNewsletterController;
use App\Http\Controllers\Admin\AdminNewsbarController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminWebsiteController;
use App\Http\Controllers\Admin\AdminRingController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminNewsletterSubmissionController;
use App\Http\Controllers\Admin\AdminShareYourMusicController;
use App\Http\Controllers\Admin\AdminContactPageController;
use App\Http\Controllers\Admin\AdminSubscriptionPlanController;
use App\Http\Controllers\Admin\AdminSubscriptionController;
use App\Http\Controllers\Admin\AdminArtistSubscriptionPlanController;
use App\Http\Controllers\Admin\AdminSongController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminArtistController;
use App\Http\Controllers\Admin\AdminGiftController;
use App\Http\Controllers\Admin\AdminServiceMusicVideoController;
use App\Http\Controllers\Admin\AdminServiceRoyaltyCollectionController;
use App\Http\Controllers\Admin\AdminServiceSupportNetworkingController;
use App\Http\Controllers\Admin\AdminServiceArtworkPhotoController;
use App\Http\Controllers\Admin\AdminServiceArtistSubscriptionController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminRoyaltyCollectionController;
use App\Http\Controllers\Admin\AdminAdController;
use App\Http\Controllers\Common\DashboardController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FeatureController;
use App\Http\Controllers\Frontend\PricingController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ArtistController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\UserPortalController;
use App\Http\Controllers\ArtistMusicController;
use App\Http\Controllers\ArtworkPhotoController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ArtistFollowController;
// use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use App\Http\Controllers\PusherController;
use App\Events\BpmBroadcasted;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Broadcast;

use Pusher\Pusher;


// Customer Chat Routes
Route::post('/chat/send', [ChatController::class, 'sendMessage']);
Route::get('/chat/history', [ChatController::class, 'getChatHistory']);


Route::get('/storage-link', function () {
    try {
        $link = public_path('storage');

        // Remove the existing link if it exists
        if (File::exists($link)) {
            File::delete($link);
        }

        // Create the symbolic link again
        Artisan::call('storage:link');

        return '✅ Storage link has been refreshed successfully!';
    } catch (\Exception $e) {
        return '❌ Failed to refresh storage link: ' . $e->getMessage();
    }
});


Route::group(['middleware' => ['guest']], function () {

    //User Login Authentication Routes
    Route::get('admin/login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('login-attempt', [LoginController::class, 'loginAttempt'])->name('login.attempt');
    Route::get('login', [LoginController::class, 'userLogin'])->name('user.login');

    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::get('user/register', [RegisterController::class, 'userRegister'])->name('user.register');
    Route::post('registration-attempt', [RegisterController::class, 'registerAttempt'])->name('register.attempt');
Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset.token');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Forgot Password with OTP Routes
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('forgot-password', [AuthController::class, 'sendOtp'])->name('password.send-otp');
Route::get('verify-otp', [AuthController::class, 'showVerifyOtpForm'])->name('password.verify-otp');
Route::post('verify-otp', [AuthController::class, 'verifyOtp'])->name('password.verify-otp.post');
Route::get('reset-password-otp', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password-otp', [AuthController::class, 'resetPasswordWithOtp'])->name('password.reset.post');


    Route::get('/artist/login', [LoginController::class, 'artistLogin'])->name('artist.login');
    Route::get('/artist/register', [RegisterController::class, 'artistRegister'])->name('artist.register');

});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/about-major-powel', [AboutController::class, 'aboutmajorpowel'])->name('about.majorpowel');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'detail'])->name('blog.detail');
Route::post('/blog/comment', [BlogController::class, 'commentStore'])->name('comment.store');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::post('/newsletter/subscribe', [WebsiteController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

// Public routes
Route::get('referral/{code}', [\App\Http\Controllers\CreditController::class, 'referral'])->name('referral');
Route::get('marketplace', [\App\Http\Controllers\MarketplaceController::class, 'index'])->name('marketplace.public.index');
Route::get('marketplace/{id}', [\App\Http\Controllers\MarketplaceController::class, 'show'])->name('marketplace.public.show');
Route::get('qa-sessions', [\App\Http\Controllers\FanInteractionController::class, 'qaSessions'])->name('qa-sessions.public.index');
Route::get('qa-sessions/{id}', [\App\Http\Controllers\FanInteractionController::class, 'viewQaSession'])->name('qa-sessions.public.show');
Route::get('previews', [\App\Http\Controllers\FanInteractionController::class, 'previews'])->name('previews.public.index');


Route::get('/user-portal', [UserPortalController::class, 'index'])->name('user.portal');

// Playlist routes
Route::middleware(['auth'])->group(function () {
    Route::get('/playlist/create', [\App\Http\Controllers\Frontend\PlaylistController::class, 'showCreatePlaylist'])->name('playlist.create');
});

// Artist subscription purchase route (web route for CSRF protection)
Route::post('/api/artist-subscription/purchase', [\App\Http\Controllers\Frontend\PlaylistController::class, 'purchaseArtistSubscription'])
    ->middleware(['auth'])
    ->name('api.artist-subscription.purchase');


Route::get('/service/musicvideo', [ServiceController::class, 'musicvideo'])->name('service.musicvideo');
Route::get('/service/royalty-collection', [ServiceController::class, 'royaltycollection'])->name('service.royaltycollection');
Route::get('/service/artisit-subscription', [ServiceController::class, 'artisitsubscription'])->name('service.artisitsubscription');
Route::get('/service/artwork-photo', [ServiceController::class, 'artworkphoto'])->name('service.artworkphoto');
Route::get('/service/support-networking', [ServiceController::class, 'supportnetworking'])->name('service.supportnetworking');


// Artist Routes - Protected by authentication and artist privileges
Route::middleware(['artist'])->group(function () {
    Route::get('artist/artisit-portal', [ArtistController::class, 'index'])->name('artist.portal');
    Route::post('artist/music/upload', [ArtistMusicController::class, 'store'])->name('artist.music.upload');
    Route::get('artist/my-music', [ArtistMusicController::class, 'index'])->name('artist.my-music');
    Route::delete('artist/music/{id}', [ArtistMusicController::class, 'destroy'])->name('artist.music.delete');

    Route::post('artist/artwork/upload', [ArtworkPhotoController::class, 'store'])->name('artist.artwork.upload');
    Route::get('artist/my-artwork', [ArtworkPhotoController::class, 'index'])->name('artist.my-artwork');
    Route::delete('artist/artwork/{id}', [ArtworkPhotoController::class, 'destroy'])->name('artist.artwork.delete');

    // Artist Analytics Routes
    Route::get('artist/analytics', [\App\Http\Controllers\Artist\ArtistAnalyticsController::class, 'index'])->name('artist.analytics.index');
    Route::get('artist/analytics/export', [\App\Http\Controllers\Artist\ArtistAnalyticsController::class, 'export'])->name('artist.analytics.export');
    Route::get('artist/analytics/demographics', [\App\Http\Controllers\Artist\ArtistAnalyticsController::class, 'demographics'])->name('artist.analytics.demographics');

    // Artist Royalty & Payout Routes
    Route::get('artist/royalty', [\App\Http\Controllers\Artist\ArtistRoyaltyController::class, 'index'])->name('artist.royalty.index');
    Route::get('artist/royalty/earnings', [\App\Http\Controllers\Artist\ArtistRoyaltyController::class, 'earnings'])->name('artist.royalty.earnings');
    Route::get('artist/royalty/payout-requests', [\App\Http\Controllers\Artist\ArtistRoyaltyController::class, 'payoutRequests'])->name('artist.royalty.payout-requests');
    Route::post('artist/royalty/payout-request', [\App\Http\Controllers\Artist\ArtistRoyaltyController::class, 'requestPayout'])->name('artist.royalty.request-payout');
    Route::get('artist/royalty/transactions', [\App\Http\Controllers\Artist\ArtistRoyaltyController::class, 'transactionHistory'])->name('artist.royalty.transactions');
    Route::get('artist/royalty/export/csv', [\App\Http\Controllers\Artist\ArtistRoyaltyController::class, 'exportEarningsCSV'])->name('artist.royalty.export.csv');

    // Artist Payment Details
    Route::post('artist/payment-details/save', [\App\Http\Controllers\Artist\ArtistPaymentDetailsController::class, 'save'])->name('artist.payment-details.save');
    Route::get('artist/payment-details', [\App\Http\Controllers\Artist\ArtistPaymentDetailsController::class, 'index'])->name('artist.payment-details');
    Route::get('artist/royalty/export/pdf', [\App\Http\Controllers\Artist\ArtistRoyaltyController::class, 'exportRoyaltyReportPDF'])->name('artist.royalty.export.pdf');
    Route::get('artist/royalty/per-track', [\App\Http\Controllers\Artist\ArtistRoyaltyController::class, 'perTrackEarnings'])->name('artist.royalty.per-track');

    // Artist Ad Revenue Routes
    Route::get('artist/ad-revenue', [\App\Http\Controllers\Artist\ArtistAdRevenueController::class, 'index'])->name('artist.ad-revenue.index');

    // Artist Fan Interaction Routes
    Route::get('artist/qa-sessions', [\App\Http\Controllers\Artist\ArtistFanInteractionController::class, 'qaSessions'])->name('artist.qa-sessions');
    Route::get('artist/qa-sessions/create', [\App\Http\Controllers\Artist\ArtistFanInteractionController::class, 'createQaSession'])->name('artist.qa-sessions.create');
    Route::post('artist/qa-sessions', [\App\Http\Controllers\Artist\ArtistFanInteractionController::class, 'storeQaSession'])->name('artist.qa-sessions.store');
    Route::get('artist/qa-sessions/{id}/questions', [\App\Http\Controllers\Artist\ArtistFanInteractionController::class, 'questions'])->name('artist.qa-sessions.questions');
    Route::post('artist/qa-questions/{id}/answer', [\App\Http\Controllers\Artist\ArtistFanInteractionController::class, 'answerQuestion'])->name('artist.qa-questions.answer');
    Route::get('artist/previews', [\App\Http\Controllers\Artist\ArtistFanInteractionController::class, 'previews'])->name('artist.previews');
    Route::get('artist/previews/create', [\App\Http\Controllers\Artist\ArtistFanInteractionController::class, 'createPreview'])->name('artist.previews.create');
    Route::post('artist/previews', [\App\Http\Controllers\Artist\ArtistFanInteractionController::class, 'storePreview'])->name('artist.previews.store');
    Route::get('artist/previews/{id}', [\App\Http\Controllers\Artist\ArtistFanInteractionController::class, 'viewPreview'])->name('artist.previews.show');

    // Artist Marketplace Routes
    Route::get('artist/marketplace', [\App\Http\Controllers\Artist\ArtistMarketplaceController::class, 'index'])->name('artist.marketplace.index');
    Route::get('artist/marketplace/create', [\App\Http\Controllers\Artist\ArtistMarketplaceController::class, 'create'])->name('artist.marketplace.create');
    Route::post('artist/marketplace', [\App\Http\Controllers\Artist\ArtistMarketplaceController::class, 'store'])->name('artist.marketplace.store');
    Route::get('artist/marketplace/{id}/edit', [\App\Http\Controllers\Artist\ArtistMarketplaceController::class, 'edit'])->name('artist.marketplace.edit');
    Route::put('artist/marketplace/{id}', [\App\Http\Controllers\Artist\ArtistMarketplaceController::class, 'update'])->name('artist.marketplace.update');
    Route::get('artist/marketplace/sales', [\App\Http\Controllers\Artist\ArtistMarketplaceController::class, 'sales'])->name('artist.marketplace.sales');
    Route::get('artist/marketplace/collaboration-requests', [\App\Http\Controllers\Artist\ArtistMarketplaceController::class, 'collaborationRequests'])->name('artist.marketplace.collaboration-requests');
    Route::post('artist/marketplace/collaboration-requests/{id}/respond', [\App\Http\Controllers\Artist\ArtistMarketplaceController::class, 'respondToCollaboration'])->name('artist.marketplace.collaboration-respond');

    // Track Collaboration Routes
    Route::get('artist/collaborations', [\App\Http\Controllers\Artist\TrackCollaborationController::class, 'index'])->name('artist.collaborations.index');
    Route::get('artist/music/{id}/collaboration/create', [\App\Http\Controllers\Artist\TrackCollaborationController::class, 'create'])->name('artist.collaborations.create');
    Route::post('artist/music/{id}/collaboration', [\App\Http\Controllers\Artist\TrackCollaborationController::class, 'store'])->name('artist.collaborations.store');
    Route::get('artist/collaborations/{id}', [\App\Http\Controllers\Artist\TrackCollaborationController::class, 'show'])->name('artist.collaborations.show');
    Route::post('artist/collaborations/{collaborationId}/splits/{splitId}/approve', [\App\Http\Controllers\Artist\TrackCollaborationController::class, 'approveSplit'])->name('artist.collaborations.approve-split');

    // Artist profile settings
    Route::get('artist/profile-settings', [\App\Http\Controllers\Artist\ArtistProfileController::class, 'edit'])->name('artist.profile.edit');
    Route::post('artist/profile-settings', [\App\Http\Controllers\Artist\ArtistProfileController::class, 'update'])->name('artist.profile.update');
    Route::post('artist/collaborations/{id}/reject', [\App\Http\Controllers\Artist\TrackCollaborationController::class, 'rejectCollaboration'])->name('artist.collaborations.reject');

    // Certified Creator Request
    Route::post('artist/certified-creator/apply', [\App\Http\Controllers\Artist\CertifiedCreatorRequestController::class, 'store'])
        ->name('artist.certified-creator.apply');
});

// Location Form Route
// Route::get('location', [LocationController::class, 'index'])->name('location.index');

// Test API route via web
Route::get('api-test', function () {
    return response()->json(['message' => 'Web API test working', 'timestamp' => now()]);
});

// Music search via web route (for testing)
Route::get('music-search', function (Request $request) {
    try {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json([
                'success' => false,
                'message' => 'Search query is required',
                'data' => []
            ], 400);
        }

        $musics = \App\Models\ArtistMusic::with('user')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->limit(20)
            ->get()
            ->map(function ($music) {
                return [
                    'id' => $music->id,
                    'name' => $music->name,
                    'artist' => $music->user->name ?? 'Unknown Artist',
                    'thumbnail' => $music->thumbnail_image_url,
                    'music_file' => $music->music_file_url,
                    'listeners' => $music->listeners,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Music search completed',
            'data' => $musics
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error searching music: ' . $e->getMessage(),
            'data' => []
        ], 500);
    }
});

// Playlist detail page
Route::get('playlist-detail', function () {
    return view('frontend.playlist-detail');
})->name('playlist.detail');

// featured-artist page - Show all artists sorted by highest subscribers
Route::get('featured-artist', function () {
    // Get all artists with their subscriber counts, sorted by highest subscribers
    $artists = \App\Models\User::where('is_artist', true)
        ->with('profile')
        ->withCount('artistFollowers as subscriber_count')
        ->orderBy('subscriber_count', 'desc')
        ->get()
        ->map(function ($artist) {
            // Get artist profile image (from profile table or default)
            $profileImage = null;
            if ($artist->profile && isset($artist->profile->profile_picture) && $artist->profile->profile_picture) {
                $profileImage = asset('storage/' . $artist->profile->profile_picture);
            } elseif (isset($artist->profile_picture) && $artist->profile_picture) {
                $profileImage = asset('storage/' . $artist->profile_picture);
            } else {
                // Default image
                $profileImage = asset('FrontendAssets/images/default-artist.jpg');
            }

            // Get total listeners from their songs
            $totalListeners = \App\Models\ArtistMusic::where('driver_id', $artist->id)
                ->sum('listeners');

            // Determine status badge based on subscriber count
            $status = 'New';
            if ($artist->subscriber_count >= 1000) {
                $status = 'Trending';
            } elseif ($artist->subscriber_count >= 500) {
                $status = 'Featured';
            } elseif ($artist->subscriber_count >= 100) {
                $status = 'Rising';
            }

            // Check if artist is featured
            if ($artist->is_featured) {
                $status = 'Featured';
            }

            return [
                'id' => $artist->id,
                'name' => $artist->name ?? $artist->username ?? 'Unknown Artist',
                'genre' => ($artist->profile && isset($artist->profile->genre)) ? $artist->profile->genre : 'Various',
                'subscribers' => $artist->subscriber_count ?? 0,
                'listeners' => $totalListeners ?? 0,
                'status' => $status,
                'image' => $profileImage,
                'is_featured' => (bool) $artist->is_featured,
            ];
        });

    return view('frontend.featured-artist', compact('artists'));
})->name('featured-artist');

// profile-setup
Route::get('profile-setup', function () {
    return view('frontend.profile-setup');
})->name('profile-setup');

// privacy-policy page
Route::get('privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy-policy');

// payout-history page
Route::get('payout-history', function () {
    return view('frontend.payout-history');
})->name('payout-history');

// all-artwork page
Route::get('all-artwork', function () {
    $artworkPhotos = [];

    // If user is authenticated and is an artist, show their artwork only
    if (auth()->check() && auth()->user()->is_artist) {
        $artworkPhotos = \App\Models\ArtworkPhoto::where('driver_id', auth()->id())
            ->latest('created_at')
            ->get();
    } else {
        // Show all public artwork or empty if not authenticated
        $artworkPhotos = \App\Models\ArtworkPhoto::with('user')
            ->latest('created_at')
            ->get();
    }

    return view('frontend.all-artwork', compact('artworkPhotos'));
})->name('all-artwork');

// Digital Artist Agreement page
Route::get('artist-agreement', function () {
    return view('frontend.artist-agreement');
})->name('artist-agreement');

// Tip Artist page - Only for Super Listener plan
Route::get('tip-artist', [\App\Http\Controllers\TipController::class, 'index'])->middleware('auth')->name('tip-artist');
Route::post('api/tip/process', [\App\Http\Controllers\TipController::class, 'processTip'])->middleware('auth')->name('api.tip.process');

// Analytics & Insights Dashboard page
Route::get('dashboard-analytics-insights', function () {
    return view('frontend.dashboard-analytics-insights');
})->name('dashboard-analytics-insights');

// Admin-Panel-dashboard page
Route::get('admin-panel-dashboard', function () {
    return view('frontend.admin-panel-dashboard');
})->name('admin-aanel-dashboard');

// Favorites detail page
Route::get('allblogs', function () {
    return view('frontend.allblogs');
})->name('allblogs');

// artist profile page (public, dynamic) - requires authentication
Route::get('artist-profile', [ArtistController::class, 'publicProfile'])
    ->middleware('auth')
    ->name('artist-profile');

// Certified creators listing page
Route::get('certified-creators', [ArtistController::class, 'certifiedCreators'])
    ->name('certified-creators');

// allartist detail page
Route::get('allartist', function () {
    return view('frontend.allartist');
})->name('allartist');

// Songs detail page
Route::get('songs-details', function () {
    return view('frontend.songs-details');
})->name('songs-details');


Route::get('favorites-detail', function () {
    return view('frontend.favorites-detail');
})->name('favorites.detail');

Route::get('songs-library', function () {
    return view('frontend.songs-library');
})->name('songs.library');

Route::get('test-songs-api', function () {
    $songs = \App\Models\ArtistMusic::with('user')->take(5)->get();
    return response()->json([
        'success' => true,
        'count' => $songs->count(),
        'songs' => $songs->map(function($song) {
            return [
                'id' => $song->id,
                'name' => $song->name,
                'artist' => $song->user ? $song->user->name : 'Unknown',
                'thumbnail' => $song->thumbnail_image_url,
            ];
        })
    ]);
});

// Driver Tracking Route
Route::get('driver-tracking', function () {
    return view('frontend.driver-tracking');
})->name('driver.tracking');
Route::get('share-music', [WebsiteController::class, 'shareMusic'])->name('share.music');

Route::group(['middleware' => ['auth']], function () {
    Route::get('login-verification', [AuthController::class, 'login_verification'])->name('login.verification');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('verify-account', [AuthController::class, 'verify_account'])->name('verify.account');
    Route::post('resend-code', [AuthController::class, 'resend_code'])->name('resend.code');


    Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verification_verify'])->middleware(['signed'])->name('verification.verify');
    Route::get('email/verify', [AuthController::class, 'verification_notice'])->name('verification.notice');
    Route::post('email/verification-notification', [AuthController::class, 'verification_send'])->middleware(['throttle:2,1'])->name('verification.send');

    // Notification Routes
    Route::get('notifications/preferences', [\App\Http\Controllers\NotificationController::class, 'preferences'])->name('notifications.preferences');
    Route::post('notifications/preferences', [\App\Http\Controllers\NotificationController::class, 'updatePreferences'])->name('notifications.preferences.update');
    Route::get('notifications/history', [\App\Http\Controllers\NotificationController::class, 'history'])->name('notifications.history');

    // Legal Documents Routes
    Route::get('legal-documents', [\App\Http\Controllers\LegalDocumentController::class, 'index'])->name('legal-documents.index');
    Route::get('legal-documents/{slug}', [\App\Http\Controllers\LegalDocumentController::class, 'show'])->name('legal-documents.show');
    Route::post('legal-documents/accept', [\App\Http\Controllers\LegalDocumentController::class, 'accept'])->name('legal-documents.accept');

    // Gift Subscriptions Routes
    Route::get('gift-subscriptions', [\App\Http\Controllers\GiftSubscriptionController::class, 'index'])->name('gift-subscriptions.index');
    Route::get('gift-subscriptions/create', [\App\Http\Controllers\GiftSubscriptionController::class, 'create'])->name('gift-subscriptions.create');
    Route::post('gift-subscriptions', [\App\Http\Controllers\GiftSubscriptionController::class, 'store'])->name('gift-subscriptions.store');
    Route::post('gift-subscriptions/{id}/activate', [\App\Http\Controllers\GiftSubscriptionController::class, 'activate'])->name('gift-subscriptions.activate');

    // Credits Routes
    Route::get('credits', [\App\Http\Controllers\CreditController::class, 'index'])->name('credits.index');
    Route::post('credits/purchase', [\App\Http\Controllers\CreditController::class, 'purchase'])->name('credits.purchase');
    Route::post('credits/redeem', [\App\Http\Controllers\CreditController::class, 'redeem'])->name('credits.redeem');

    // Fan Interaction Routes
    Route::get('qa-sessions', [\App\Http\Controllers\FanInteractionController::class, 'qaSessions'])->name('qa-sessions.index');
    Route::get('qa-sessions/{id}', [\App\Http\Controllers\FanInteractionController::class, 'viewQaSession'])->name('qa-sessions.show');
    Route::post('qa-sessions/{id}/ask', [\App\Http\Controllers\FanInteractionController::class, 'askQuestion'])->name('qa-sessions.ask');
    Route::post('qa-questions/{id}/upvote', [\App\Http\Controllers\FanInteractionController::class, 'upvoteQuestion'])->name('qa-questions.upvote');
    Route::get('previews', [\App\Http\Controllers\FanInteractionController::class, 'previews'])->name('previews.index');

    // Marketplace Routes
    Route::get('marketplace', [\App\Http\Controllers\MarketplaceController::class, 'index'])->name('marketplace.index');
    Route::get('marketplace/{id}', [\App\Http\Controllers\MarketplaceController::class, 'show'])->name('marketplace.show');
    Route::post('marketplace/{id}/purchase', [\App\Http\Controllers\MarketplaceController::class, 'purchase'])->name('marketplace.purchase');
    Route::get('marketplace/purchase/{id}/confirmation', [\App\Http\Controllers\MarketplaceController::class, 'purchaseConfirmation'])->name('marketplace.purchase-confirmation');
    Route::post('marketplace/purchases/{id}/review', [\App\Http\Controllers\MarketplaceController::class, 'review'])->name('marketplace.review');
    Route::post('marketplace/{id}/request-collaboration', [\App\Http\Controllers\MarketplaceController::class, 'requestCollaboration'])->name('marketplace.request-collaboration');

    // Artist subscriptions/followers (fan subscribes to artist updates)
    Route::post('artist/subscribe', [ArtistFollowController::class, 'toggle'])->name('artist.subscribe');

});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // FAQ Routes
    Route::get('faq', [AdminFaqController::class, 'index'])->name('faq.index');
    Route::get('faq/add', [AdminFaqController::class, 'add'])->name('faq.add');
    Route::post('faq/store', [AdminFaqController::class, 'store'])->name('faq.store');
    Route::get('faq/{id}/edit', [AdminFaqController::class, 'edit'])->name('faq.edit');
    Route::put('faq/{id}', [AdminFaqController::class, 'update'])->name('faq.update');
    Route::delete('faq/{id}', [AdminFaqController::class, 'destroy'])->name('faq.destroy');
    Route::post('faq/{id}/toggle-visibility', [AdminFaqController::class, 'toggleVisibility'])->name('faq.toggleVisibility');

    // Chatbot QnA (FAQ Questions) Routes
    Route::get('faq-question', [AdminFAQQuestionController::class, 'index'])->name('faq-question.index');
    Route::get('faq-question/create', [AdminFAQQuestionController::class, 'create'])->name('faq-question.create');
    Route::post('faq-question/store', [AdminFAQQuestionController::class, 'store'])->name('faq-question.store');
    Route::get('faq-question/{id}/edit', [AdminFAQQuestionController::class, 'edit'])->name('faq-question.edit');
    Route::put('faq-question/{id}', [AdminFAQQuestionController::class, 'update'])->name('faq-question.update');
    Route::delete('faq-question/{id}', [AdminFAQQuestionController::class, 'destroy'])->name('faq-question.destroy');
    Route::post('faq-question/{id}/toggle-status', [AdminFAQQuestionController::class, 'toggleStatus'])->name('faq-question.toggleStatus');

    // Chatbot Conversations Routes
    Route::get('chatbot', [AdminChatbotController::class, 'index'])->name('chatbot.index');
    Route::get('chatbot/users', [AdminChatbotController::class, 'getUsersList'])->name('chatbot.users');
    Route::get('chatbot/conversation', [AdminChatbotController::class, 'getUserConversation'])->name('chatbot.conversation');

    // Partner Routes
    Route::get('partner', [AdminPartnerController::class, 'index'])->name('partner.index');
    Route::get('partner/add', [AdminPartnerController::class, 'add'])->name('partner.add');
    Route::post('partner/store', [AdminPartnerController::class, 'store'])->name('partner.store');
    Route::get('partner/{id}/edit', [AdminPartnerController::class, 'edit'])->name('partner.edit');
    Route::put('partner/{id}', [AdminPartnerController::class, 'update'])->name('partner.update');
    Route::delete('partner/{id}', [AdminPartnerController::class, 'destroy'])->name('partner.destroy');
    Route::post('partner/{id}/toggle-visibility', [AdminPartnerController::class, 'toggleVisibility'])->name('partner.toggleVisibility');

    // Social Share Music Routes
    // Route::get('cms/social-share-music', [AdminSocialShareMusicController::class, 'index'])->name('cms-social-share-music.index');
    // Route::get('cms/royaltycollection', [AdminRoyaltyCollectionController::class, 'index'])->name('cms-royaltycollection.index');
    // Route::get('social-share-music', [AdminSocialShareMusicController::class, 'index'])->name('social-share-music.index');
    // Route::get('social-share-music/add', [AdminSocialShareMusicController::class, 'add'])->name('social-share-music.add');
    // Route::post('social-share-music/store', [AdminSocialShareMusicController::class, 'store'])->name('social-share-music.store');
    // Route::get('social-share-music/{id}/edit', [AdminSocialShareMusicController::class, 'edit'])->name('social-share-music.edit');
    // Route::put('social-share-music/{id}', [AdminSocialShareMusicController::class, 'update'])->name('social-share-music.update');
    // Route::delete('social-share-music/{id}', [AdminSocialShareMusicController::class, 'destroy'])->name('social-share-music.destroy');
    // Route::post('social-share-music/{id}/toggle-visibility', [AdminSocialShareMusicController::class, 'toggleVisibility'])->name('social-share-music.toggleVisibility');

    // Live Video Routes
    Route::get('live-video', [AdminLiveVideoController::class, 'index'])->name('live-video.index');
    Route::get('live-video/add', [AdminLiveVideoController::class, 'add'])->name('live-video.add');
    Route::post('live-video/store', [AdminLiveVideoController::class, 'store'])->name('live-video.store');
    Route::get('live-video/{id}/edit', [AdminLiveVideoController::class, 'edit'])->name('live-video.edit');
    Route::put('live-video/{id}', [AdminLiveVideoController::class, 'update'])->name('live-video.update');
    Route::delete('live-video/{id}', [AdminLiveVideoController::class, 'destroy'])->name('live-video.destroy');
    Route::post('live-video/{id}/toggle-visibility', [AdminLiveVideoController::class, 'toggleVisibility'])->name('live-video.toggleVisibility');



    // Blog Routes
    Route::get('blog', [AdminBlogController::class, 'index'])->name('blog.index');
    Route::get('blog/add', [AdminBlogController::class, 'add'])->name('blog.add');
    Route::post('blog/store', [AdminBlogController::class, 'store'])->name('blog.store');
    Route::get('blog/{id}/edit', [AdminBlogController::class, 'edit'])->name('blog.edit');
    Route::put('blog/{id}', [AdminBlogController::class, 'update'])->name('blog.update');
    Route::delete('blog/{id}', [AdminBlogController::class, 'destroy'])->name('blog.destroy');
    Route::post('blog/{id}/toggle-visibility', [AdminBlogController::class, 'toggleVisibility'])->name('blog.toggleVisibility');

    // Tether Work Routes
    Route::get('tether-work', [AdminTetherWorkController::class, 'index'])->name('tether-work.index');
    Route::get('tether-work/add', [AdminTetherWorkController::class, 'add'])->name('tether-work.add');
    Route::post('tether-work/store', [AdminTetherWorkController::class, 'store'])->name('tether-work.store');
    Route::get('tether-work/{id}/edit', [AdminTetherWorkController::class, 'edit'])->name('tether-work.edit');
    Route::put('tether-work/{id}', [AdminTetherWorkController::class, 'update'])->name('tether-work.update');
    Route::delete('tether-work/{id}', [AdminTetherWorkController::class, 'destroy'])->name('tether-work.destroy');

    // Wellness Routes
    // Route::get('wellness', [AdminWellnessController::class, 'index'])->name('wellness.index');
    // Route::get('wellness/add', [AdminWellnessController::class, 'add'])->name('wellness.add');
    // Route::post('wellness/store', [AdminWellnessController::class, 'store'])->name('wellness.store');
    // Route::get('wellness/{id}/edit', [AdminWellnessController::class, 'edit'])->name('wellness.edit');
    // Route::put('wellness/{id}', [AdminWellnessController::class, 'update'])->name('wellness.update');
    // Route::delete('wellness/{id}', [AdminWellnessController::class, 'destroy'])->name('wellness.destroy');
    // Route::post('wellness/{id}/toggle-visibility', [AdminWellnessController::class, 'toggleVisibility'])->name('wellness.toggleVisibility');

    // Service Music Video Routes
    Route::get('service/musicvideo', [AdminServiceMusicVideoController::class, 'index'])->name('service.musicvideo.index');
    Route::get('service/musicvideo/add', [AdminServiceMusicVideoController::class, 'add'])->name('service.musicvideo.add');
    Route::post('service/musicvideo/store', [AdminServiceMusicVideoController::class, 'store'])->name('service.musicvideo.store');
    Route::get('service/musicvideo/{id}/edit', [AdminServiceMusicVideoController::class, 'edit'])->name('service.musicvideo.edit');
    Route::put('service/musicvideo/{id}', [AdminServiceMusicVideoController::class, 'update'])->name('service.musicvideo.update');
    Route::delete('service/musicvideo/{id}', [AdminServiceMusicVideoController::class, 'destroy'])->name('service.musicvideo.destroy');

    // Service Royalty Collection Routes
    Route::get('service/royaltycollection', [AdminServiceRoyaltyCollectionController::class, 'index'])->name('service.royaltycollection.index');
    Route::get('service/royaltycollection/add', [AdminServiceRoyaltyCollectionController::class, 'add'])->name('service.royaltycollection.add');
    Route::post('service/royaltycollection/store', [AdminServiceRoyaltyCollectionController::class, 'store'])->name('service.royaltycollection.store');
    Route::get('service/royaltycollection/{id}/edit', [AdminServiceRoyaltyCollectionController::class, 'edit'])->name('service.royaltycollection.edit');
    Route::put('service/royaltycollection/{id}', [AdminServiceRoyaltyCollectionController::class, 'update'])->name('service.royaltycollection.update');
    Route::delete('service/royaltycollection/{id}', [AdminServiceRoyaltyCollectionController::class, 'destroy'])->name('service.royaltycollection.destroy');

// Support Networking Services
Route::get('service/supportnetworking', [AdminServiceSupportNetworkingController::class, 'index'])->name('service.supportnetworking.index');
Route::get('service/supportnetworking/add', [AdminServiceSupportNetworkingController::class, 'add'])->name('service.supportnetworking.add');
Route::post('service/supportnetworking/store', [AdminServiceSupportNetworkingController::class, 'store'])->name('service.supportnetworking.store');
Route::get('service/supportnetworking/{id}/edit', [AdminServiceSupportNetworkingController::class, 'edit'])->name('service.supportnetworking.edit');
Route::put('service/supportnetworking/{id}', [AdminServiceSupportNetworkingController::class, 'update'])->name('service.supportnetworking.update');
Route::delete('service/supportnetworking/{id}', [AdminServiceSupportNetworkingController::class, 'destroy'])->name('service.supportnetworking.destroy');

// Artwork Photo Services
Route::get('service/artworkphoto', [AdminServiceArtworkPhotoController::class, 'index'])->name('service.artworkphoto.index');
Route::get('service/artworkphoto/add', [AdminServiceArtworkPhotoController::class, 'add'])->name('service.artworkphoto.add');
Route::post('service/artworkphoto/store', [AdminServiceArtworkPhotoController::class, 'store'])->name('service.artworkphoto.store');
Route::get('service/artworkphoto/{id}/edit', [AdminServiceArtworkPhotoController::class, 'edit'])->name('service.artworkphoto.edit');
Route::put('service/artworkphoto/{id}', [AdminServiceArtworkPhotoController::class, 'update'])->name('service.artworkphoto.update');
Route::delete('service/artworkphoto/{id}', [AdminServiceArtworkPhotoController::class, 'destroy'])->name('service.artworkphoto.destroy');

// Artist Subscription Services
Route::get('service/artistsubscription', [AdminServiceArtistSubscriptionController::class, 'index'])->name('service.artistsubscription.index');
Route::get('service/artistsubscription/add', [AdminServiceArtistSubscriptionController::class, 'add'])->name('service.artistsubscription.add');
Route::post('service/artistsubscription/store', [AdminServiceArtistSubscriptionController::class, 'store'])->name('service.artistsubscription.store');
Route::get('service/artistsubscription/{id}/edit', [AdminServiceArtistSubscriptionController::class, 'edit'])->name('service.artistsubscription.edit');
Route::put('service/artistsubscription/{id}', [AdminServiceArtistSubscriptionController::class, 'update'])->name('service.artistsubscription.update');
Route::delete('service/artistsubscription/{id}', [AdminServiceArtistSubscriptionController::class, 'destroy'])->name('service.artistsubscription.destroy');

        Route::get('subplan', [AdminSubscriptionPlanController::class, 'index'])->name('subplan.index');
    Route::get('subplan/add', [AdminSubscriptionPlanController::class, 'add'])->name('subplan.add');
    Route::post('subplan/store', [AdminSubscriptionPlanController::class, 'store'])->name('subplan.store');
    Route::get('subplan/{id}/edit', [AdminSubscriptionPlanController::class, 'edit'])->name('subplan.edit');
    Route::put('subplan/{id}', [AdminSubscriptionPlanController::class, 'update'])->name('subplan.update');
    Route::delete('subplan/{id}', [AdminSubscriptionPlanController::class, 'destroy'])->name('subplan.destroy');

    // Subscription Plans Routes
    Route::get('subscription', [AdminSubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('subscription/add', [AdminSubscriptionController::class, 'add'])->name('subscription.add');
    Route::post('subscription/store', [AdminSubscriptionController::class, 'store'])->name('subscription.store');
    Route::get('subscription/{id}/edit', [AdminSubscriptionController::class, 'edit'])->name('subscription.edit');
    Route::put('subscription/{id}', [AdminSubscriptionController::class, 'update'])->name('subscription.update');
    Route::delete('subscription/{id}', [AdminSubscriptionController::class, 'destroy'])->name('subscription.destroy');

    // Artist Subscription Plans Routes
    Route::get('artist-subscription-plans', [AdminArtistSubscriptionPlanController::class, 'index'])->name('artist-subscription-plans.index');
    Route::get('artist-subscription-plans/add', [AdminArtistSubscriptionPlanController::class, 'add'])->name('artist-subscription-plans.add');
    Route::post('artist-subscription-plans/store', [AdminArtistSubscriptionPlanController::class, 'store'])->name('artist-subscription-plans.store');
    Route::get('artist-subscription-plans/{id}/edit', [AdminArtistSubscriptionPlanController::class, 'edit'])->name('artist-subscription-plans.edit');
    Route::put('artist-subscription-plans/{id}', [AdminArtistSubscriptionPlanController::class, 'update'])->name('artist-subscription-plans.update');
    Route::delete('artist-subscription-plans/{id}', [AdminArtistSubscriptionPlanController::class, 'destroy'])->name('artist-subscription-plans.destroy');

    // Customer Routes
    Route::get('customer', [AdminCustomerController::class, 'index'])->name('customer.index');
    Route::get('customer/add', [AdminCustomerController::class, 'add'])->name('customer.add');
    Route::post('customer/store', [AdminCustomerController::class, 'store'])->name('customer.store');
    Route::get('customer/{id}/edit', [AdminCustomerController::class, 'edit'])->name('customer.edit');
    Route::put('customer/{id}', [AdminCustomerController::class, 'update'])->name('customer.update');
    Route::delete('customer/{id}', [AdminCustomerController::class, 'destroy'])->name('customer.destroy');
    Route::post('customer/{id}/toggle-status', [AdminCustomerController::class, 'toggleStatus'])->name('customer.toggleStatus');
    Route::post('customer/{id}/toggle-featured', [AdminCustomerController::class, 'toggleFeatured'])->name('customer.toggleFeatured');

    // Songs / Tracks Routes
    Route::get('songs', [AdminSongController::class, 'index'])->name('songs.index');
    Route::post('songs/{id}/toggle-featured', [AdminSongController::class, 'toggleFeatured'])->name('songs.toggleFeatured');

    // Artist Routes
    Route::get('artist', [AdminArtistController::class, 'index'])->name('artist.index');
    Route::post('artist/{id}/toggle-featured', [AdminArtistController::class, 'toggleFeatured'])->name('artist.toggleFeatured');

    // About Section Routes

        Route::get('newsbar', [AdminNewsbarController::class, 'index'])->name('newsbar.index');
    Route::get('newsbar/add', [AdminNewsbarController::class, 'add'])->name('newsbar.add');
    Route::post('newsbar/store', [AdminNewsbarController::class, 'store'])->name('newsbar.store');
    Route::get('newsbar/{id}/edit', [AdminNewsbarController::class, 'edit'])->name('newsbar.edit');
    Route::put('newsbar/{id}', [AdminNewsbarController::class, 'update'])->name('newsbar.update');
    Route::delete('newsbar/{id}', [AdminNewsbarController::class, 'destroy'])->name('newsbar.destroy');

    // Newsletter Routes
    Route::get('newsletter', [AdminNewsletterController::class, 'index'])->name('newsletter.index');
    Route::get('newsletter/add', [AdminNewsletterController::class, 'add'])->name('newsletter.add');
    Route::post('newsletter/store', [AdminNewsletterController::class, 'store'])->name('newsletter.store');
    Route::get('newsletter/{id}/edit', [AdminNewsletterController::class, 'edit'])->name('newsletter.edit');
    Route::put('newsletter/{id}', [AdminNewsletterController::class, 'update'])->name('newsletter.update');
    Route::delete('newsletter/{id}', [AdminNewsletterController::class, 'destroy'])->name('newsletter.destroy');
    Route::post('newsletter/{id}/toggle-visibility', [AdminNewsletterController::class, 'toggleVisibility'])->name('newsletter.toggleVisibility');

    // Company Settings
    Route::get('company-settings', [AdminSettingController::class, 'index'])->name('company.settings');

    // Website CMS sections
    Route::get('website', [AdminWebsiteController::class, 'index'])->name('website.index');
    Route::get('royalty-cms', [AdminWebsiteController::class, 'royaltycms'])->name('royalty.cms');
    Route::get('contact', [AdminContactPageController::class, 'index'])->name('contact.index');
    Route::get('shareyourmusic', [AdminShareYourMusicController::class, 'cmsindex'])->name('cms.shareyourmusic.index');
    Route::put('shareyourmusic/update', [AdminShareYourMusicController::class, 'cmsupdate'])->name('cms.shareyourmusic.update');
    Route::get('about', [AdminAboutController::class, 'index'])->name('about.index');
    Route::put('about/update', [AdminAboutController::class, 'update'])->name('about.update');
    Route::put('website/sections/update', [AdminWebsiteController::class, 'updateAllSections'])->name('website.sections.update');
    Route::put('contact/sections/update', [AdminContactPageController::class, 'updateContact'])->name('contact.update');

    Route::put('royalty/update', [AdminWebsiteController::class, 'updateRoyaltyCms'])->name('royalty.update');

    Route::get('contacts', [AdminContactPageController::class, 'index'])->name('contactsubmission.index');
    Route::get('contactlist', [AdminContactController::class, 'index'])->name('contactlist');
    Route::get('newsletterlist', [AdminNewsletterSubmissionController::class, 'index'])->name('newsletterlist');
    Route::delete('newsletterlist/{id}', [AdminNewsletterSubmissionController::class, 'destroy'])->name('newsletterlist.destroy');
Route::delete('contacts/{id}', [AdminContactController::class, 'destroy'])->name('contact.destroy');


    Route::get('orders/gift', [AdminOrderController::class, 'giftIndex'])->name('gift.orders');
    Route::delete('orders/gift/{id}', [AdminOrderController::class, 'giftDestroy'])->name('gift.orders.destroy');

        Route::get('orders/ring', [AdminOrderController::class, 'ringIndex'])->name('ring.orders');
    Route::delete('orders/ring/{id}', [AdminOrderController::class, 'ringDestroy'])->name('ring.orders.destroy');

    // Ads Routes
    Route::get('ads', [AdminAdController::class, 'index'])->name('ads.index');
    Route::get('ads/create', [AdminAdController::class, 'create'])->name('ads.create');
    Route::post('ads', [AdminAdController::class, 'store'])->name('ads.store');
    Route::get('ads/{id}/edit', [AdminAdController::class, 'edit'])->name('ads.edit');
    Route::put('ads/{id}', [AdminAdController::class, 'update'])->name('ads.update');
    Route::delete('ads/{id}', [AdminAdController::class, 'destroy'])->name('ads.destroy');
    Route::post('ads/{id}/toggle-visibility', [AdminAdController::class, 'toggleVisibility'])->name('ads.toggleVisibility');

    // Artist Analytics Routes
    Route::get('analytics', [\App\Http\Controllers\Admin\AdminArtistAnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('analytics/{id}', [\App\Http\Controllers\Admin\AdminArtistAnalyticsController::class, 'show'])->name('analytics.show');
    Route::get('analytics/export', [\App\Http\Controllers\Admin\AdminArtistAnalyticsController::class, 'export'])->name('analytics.export');

    // Royalty & Payout Routes
    Route::get('royalty', [\App\Http\Controllers\Admin\AdminRoyaltyController::class, 'index'])->name('royalty.index');
    Route::get('royalty/payout-requests', [\App\Http\Controllers\Admin\AdminRoyaltyController::class, 'payoutRequests'])->name('royalty.payout-requests');
    Route::get('royalty/payout-requests/{id}', [\App\Http\Controllers\Admin\AdminRoyaltyController::class, 'showPayoutRequest'])->name('royalty.payout.show');
    Route::post('royalty/payout/{id}/approve', [\App\Http\Controllers\Admin\AdminRoyaltyController::class, 'approvePayout'])->name('royalty.payout.approve');
    Route::post('royalty/payout/{id}/reject', [\App\Http\Controllers\Admin\AdminRoyaltyController::class, 'rejectPayout'])->name('royalty.payout.reject');
    Route::post('royalty/payout/{id}/complete', [\App\Http\Controllers\Admin\AdminRoyaltyController::class, 'completePayout'])->name('royalty.payout.complete');
    Route::post('royalty/set-platform-revenue', [\App\Http\Controllers\Admin\AdminRoyaltyController::class, 'setPlatformRevenue'])->name('royalty.set-platform-revenue');
    Route::post('royalty/calculate', [\App\Http\Controllers\Admin\AdminRoyaltyController::class, 'calculateRoyalties'])->name('royalty.calculate');
    Route::get('royalty/report', [\App\Http\Controllers\Admin\AdminRoyaltyController::class, 'generateReport'])->name('royalty.report');

    // Tip Management Routes (View only - tips are sent directly to artists)
    Route::get('tips', [\App\Http\Controllers\Admin\AdminTipController::class, 'index'])->name('tips.index');
    Route::get('tips/{id}', [\App\Http\Controllers\Admin\AdminTipController::class, 'show'])->name('tips.show');

    // Notification Management Routes
    Route::get('notifications/templates', [\App\Http\Controllers\Admin\AdminNotificationController::class, 'templates'])->name('notifications.templates');
    Route::get('notifications/templates/create', [\App\Http\Controllers\Admin\AdminNotificationController::class, 'createTemplate'])->name('notifications.templates.create');
    Route::post('notifications/templates', [\App\Http\Controllers\Admin\AdminNotificationController::class, 'storeTemplate'])->name('notifications.templates.store');
    Route::get('notifications/templates/{id}/edit', [\App\Http\Controllers\Admin\AdminNotificationController::class, 'editTemplate'])->name('notifications.templates.edit');
    Route::put('notifications/templates/{id}', [\App\Http\Controllers\Admin\AdminNotificationController::class, 'updateTemplate'])->name('notifications.templates.update');
    Route::delete('notifications/templates/{id}', [\App\Http\Controllers\Admin\AdminNotificationController::class, 'deleteTemplate'])->name('notifications.templates.delete');
    Route::get('notifications/logs', [\App\Http\Controllers\Admin\AdminNotificationController::class, 'logs'])->name('notifications.logs');

    // Legal Documents Routes
    Route::get('legal-documents', [\App\Http\Controllers\Admin\AdminLegalDocumentController::class, 'index'])->name('legal-documents.index');
    Route::get('legal-documents/create', [\App\Http\Controllers\Admin\AdminLegalDocumentController::class, 'create'])->name('legal-documents.create');
    Route::post('legal-documents', [\App\Http\Controllers\Admin\AdminLegalDocumentController::class, 'store'])->name('legal-documents.store');
    Route::get('legal-documents/{id}/edit', [\App\Http\Controllers\Admin\AdminLegalDocumentController::class, 'edit'])->name('legal-documents.edit');
    Route::put('legal-documents/{id}', [\App\Http\Controllers\Admin\AdminLegalDocumentController::class, 'update'])->name('legal-documents.update');
    Route::get('legal-documents/{id}/versions', [\App\Http\Controllers\Admin\AdminLegalDocumentController::class, 'versions'])->name('legal-documents.versions');
    Route::delete('legal-documents/{id}', [\App\Http\Controllers\Admin\AdminLegalDocumentController::class, 'delete'])->name('legal-documents.delete');

    // Ad Revenue Routes
    Route::get('ad-revenue', [\App\Http\Controllers\Admin\AdminAdRevenueController::class, 'index'])->name('ad-revenue.index');
    Route::get('ad-revenue/impressions', [\App\Http\Controllers\Admin\AdminAdRevenueController::class, 'impressions'])->name('ad-revenue.impressions');
    Route::post('ad-revenue/calculate', [\App\Http\Controllers\Admin\AdminAdRevenueController::class, 'calculateRevenue'])->name('ad-revenue.calculate');
    Route::post('ad-revenue/{id}/mark-paid', [\App\Http\Controllers\Admin\AdminAdRevenueController::class, 'markPaid'])->name('ad-revenue.mark-paid');

    // Credits Management Routes
    Route::get('credits', [\App\Http\Controllers\Admin\AdminCreditController::class, 'index'])->name('credits.index');
    Route::get('credits/transactions', [\App\Http\Controllers\Admin\AdminCreditController::class, 'transactions'])->name('credits.transactions');
    Route::get('credits/redemptions', [\App\Http\Controllers\Admin\AdminCreditController::class, 'redemptions'])->name('credits.redemptions');
    Route::get('credits/referrals', [\App\Http\Controllers\Admin\AdminCreditController::class, 'referrals'])->name('credits.referrals');
    Route::post('credits/{userId}/adjust', [\App\Http\Controllers\Admin\AdminCreditController::class, 'adjustCredits'])->name('credits.adjust');

    // Sponsored Playlists Routes
    Route::get('sponsored-playlists/partnerships', [\App\Http\Controllers\Admin\AdminSponsoredPlaylistController::class, 'partnerships'])->name('sponsored-playlists.partnerships');
    Route::get('sponsored-playlists/partnerships/create', [\App\Http\Controllers\Admin\AdminSponsoredPlaylistController::class, 'createPartnership'])->name('sponsored-playlists.partnerships.create');
    Route::post('sponsored-playlists/partnerships', [\App\Http\Controllers\Admin\AdminSponsoredPlaylistController::class, 'storePartnership'])->name('sponsored-playlists.partnerships.store');
    Route::get('sponsored-playlists/playlists', [\App\Http\Controllers\Admin\AdminSponsoredPlaylistController::class, 'playlists'])->name('sponsored-playlists.playlists');
    Route::get('sponsored-playlists/playlists/create', [\App\Http\Controllers\Admin\AdminSponsoredPlaylistController::class, 'createPlaylist'])->name('sponsored-playlists.playlists.create');
    Route::post('sponsored-playlists/playlists', [\App\Http\Controllers\Admin\AdminSponsoredPlaylistController::class, 'storePlaylist'])->name('sponsored-playlists.playlists.store');
    Route::post('sponsored-playlists/playlists/{id}/add-music', [\App\Http\Controllers\Admin\AdminSponsoredPlaylistController::class, 'addMusicToPlaylist'])->name('sponsored-playlists.playlists.add-music');
    Route::get('sponsored-playlists/collaborations', [\App\Http\Controllers\Admin\AdminSponsoredPlaylistController::class, 'collaborations'])->name('sponsored-playlists.collaborations');
    Route::get('sponsored-playlists/collaborations/create', [\App\Http\Controllers\Admin\AdminSponsoredPlaylistController::class, 'createCollaboration'])->name('sponsored-playlists.collaborations.create');
    Route::post('sponsored-playlists/collaborations', [\App\Http\Controllers\Admin\AdminSponsoredPlaylistController::class, 'storeCollaboration'])->name('sponsored-playlists.collaborations.store');

    // Collaboration Revenue Routes
    Route::get('collaborations/distributions', [\App\Http\Controllers\Admin\AdminCollaborationRevenueController::class, 'distributions'])->name('collaborations.distributions');
    Route::post('collaborations/calculate-revenue', [\App\Http\Controllers\Admin\AdminCollaborationRevenueController::class, 'calculateRevenue'])->name('collaborations.calculate-revenue');
    Route::post('collaborations/mark-paid', [\App\Http\Controllers\Admin\AdminCollaborationRevenueController::class, 'markPaid'])->name('collaborations.mark-paid');

    // Certified Creator Requests
    Route::get('certified-creator-requests', [\App\Http\Controllers\Admin\AdminCertifiedCreatorRequestController::class, 'index'])
        ->name('certified-creator-requests.index');
    Route::get('certified-creator-requests/{id}', [\App\Http\Controllers\Admin\AdminCertifiedCreatorRequestController::class, 'show'])
        ->name('certified-creator-requests.show');
    Route::post('certified-creator-requests/{id}/approve', [\App\Http\Controllers\Admin\AdminCertifiedCreatorRequestController::class, 'approve'])
        ->name('certified-creator-requests.approve');
    Route::post('certified-creator-requests/{id}/reject', [\App\Http\Controllers\Admin\AdminCertifiedCreatorRequestController::class, 'reject'])
        ->name('certified-creator-requests.reject');

});

// TEMPORARY: Test logging route for debugging
Route::get('logtest', function() {
    \Log::info('Log test route hit!');
    return 'Logged!';
});




