<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\FAQQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get basic stats
        $totalUsers = ChatMessage::where('type', 'user')
            ->distinct('session_id')
            ->count('session_id');
        
        $totalMessages = ChatMessage::count();
        $totalFAQs = FAQQuestion::where('is_active', true)->count();
        
        // Get recent users
        $recentUsers = ChatMessage::select('session_id', 'name', 'email')
            ->selectRaw('MAX(created_at) as last_message_at')
            ->where('type', 'user')
            ->groupBy('session_id', 'name', 'email')
            ->orderBy('last_message_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('totalUsers', 'totalMessages', 'totalFAQs', 'recentUsers'));
    }

    public function getUsersList(): JsonResponse
    {
        try {
            // Get unique users with their latest message info
            $users = ChatMessage::select('session_id', 'name', 'email')
                ->selectRaw('MAX(created_at) as last_message_at')
                ->selectRaw('COUNT(*) as message_count')
                ->where('type', 'user')
                ->groupBy('session_id', 'name', 'email')
                ->orderBy('last_message_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'users' => $users
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while retrieving users list'
            ], 500);
        }
    }

    public function getUserConversation(Request $request): JsonResponse
    {
        try {
            $sessionId = $request->query('session_id');
            
            if (!$sessionId) {
                return response()->json([
                    'success' => false,
                    'error' => 'Session ID is required'
                ], 400);
            }

            $messages = ChatMessage::where('session_id', $sessionId)
                ->orderBy('created_at', 'asc')
                ->get();

            // Get user info
            $userInfo = ChatMessage::where('session_id', $sessionId)
                ->where('type', 'user')
                ->first();

            return response()->json([
                'success' => true,
                'user_info' => $userInfo,
                'messages' => $messages
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while retrieving user conversation'
            ], 500);
        }
    }

    public function getFAQQuestions(): JsonResponse
    {
        try {
            $faqs = FAQQuestion::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'faqs' => $faqs
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while retrieving FAQ questions'
            ], 500);
        }
    }

    public function addFAQQuestion(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'question' => 'required|string|max:1000',
                'answer' => 'required|string|max:2000',
                'keywords' => 'required|string|max:500'
            ]);

            $faq = FAQQuestion::create([
                'question' => $request->question,
                'answer' => $request->answer,
                'keywords' => $request->keywords,
                'is_active' => true
            ]);

            return response()->json([
                'success' => true,
                'faq' => $faq
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while adding FAQ question'
            ], 500);
        }
    }
}
