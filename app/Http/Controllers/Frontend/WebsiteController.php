<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Models\SocialShareMusic;
use App\Models\ShareYourMusicSection;
use App\Models\NewNewsletter;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    public function shareMusic(){
        
        $socialShareMusic = SocialShareMusic::where('visibility', 1)->get();
        $shareyourmusic = ShareYourMusicSection::first();
        return view("frontend.share-music", compact('socialShareMusic', 'shareyourmusic'));
    }

    public function subscribeNewsletter(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please provide a valid email address.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $email = $request->email;

            $existingNewsletter = NewNewsletter::where('email', $email)->first();
            
            if ($existingNewsletter) {
                return response()->json([
                    'success' => false,
                    'message' => 'This email is already subscribed to our newsletter!'
                ], 409);
            }

            $newsletter = NewNewsletter::create([
                'email' => $email,
            ]);

            if ($newsletter) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for subscribing to our newsletter! You will receive updates soon.'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ], 500);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again later.'
            ], 500);
        }
    }
}
