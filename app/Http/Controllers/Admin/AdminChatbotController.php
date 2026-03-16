<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\FAQQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminChatbotController extends Controller
{
    /**
     * Display chatbot dashboard with stats and user conversations
     */
    public function index()
    {
        try {
            // Get statistics
            $totalUsers = ChatMessage::where('type', 'user')
                ->distinct('session_id')
                ->count('session_id');
            
            $totalMessages = ChatMessage::count();
            $totalFAQs = FAQQuestion::where('is_active', true)->count();
            
            // Get recent users with their message counts
            $recentUsers = ChatMessage::select('session_id', 'name', 'email')
                ->selectRaw('MAX(created_at) as last_message_at')
                ->selectRaw('COUNT(*) as message_count')
                ->where('type', 'user')
                ->groupBy('session_id', 'name', 'email')
                ->orderBy('last_message_at', 'desc')
                ->get();

            return view('admin.chatbot.index', compact('totalUsers', 'totalMessages', 'totalFAQs', 'recentUsers'));
        } catch (\Exception $e) {
            Log::error('Error loading chatbot dashboard:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('admin.dashboard')
                ->with('error', 'Error loading chatbot dashboard: ' . $e->getMessage());
        }
    }

    /**
     * Get users list for AJAX
     */
    public function getUsersList()
    {
        try {
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
            Log::error('Error retrieving users list:', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'An error occurred while retrieving users list'
            ], 500);
        }
    }

    /**
     * Get user conversation for AJAX
     */
    public function getUserConversation(Request $request)
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
            Log::error('Error retrieving user conversation:', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'An error occurred while retrieving user conversation'
            ], 500);
        }
    }
}
