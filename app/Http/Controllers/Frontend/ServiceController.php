<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LiveVideo;
use Illuminate\Support\Facades\Log;
use App\Models\ServiceRoyaltyCollection;
use App\Models\ServiceArtistSubscription;
use App\Models\ServiceArtworkPhoto;
use App\Models\ServiceSupportNetworking;
use App\Models\CmsRoyaltyCollection;

class ServiceController extends Controller
{
    public function musicvideo(){
        $live_videos = LiveVideo::where('visibility', 1)->latest()->take(10)->get();
        return view("frontend.services.musicvideoupload", compact('live_videos'));
    }

    public function royaltycollection(){
        $royalty_collections = ServiceRoyaltyCollection::all();
        $royalty_collections_cms = CmsRoyaltyCollection::first();
        return view("frontend.services.royaltycollection", compact('royalty_collections', 'royalty_collections_cms'));
    }

    public function artisitsubscription(){
        $artistsubscriptions = ServiceArtistSubscription::all();
        // Get artist subscription plans for pricing display
        $artist_plans = \App\Models\ArtistSubscriptionPlan::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('monthly_fee')
            ->get();
        return view("frontend.services.artistsubscription", compact('artistsubscriptions', 'artist_plans'));
    }

    public function artworkphoto(){
        $artworkphotos = ServiceArtworkPhoto::all();
        return view("frontend.services.artworkphotoupload", compact('artworkphotos'));
    }

    public function supportnetworking(){
        $supportnetworkings = ServiceSupportNetworking::all();
        return view("frontend.services.supportnetworking", compact('supportnetworkings'));
    }

}
