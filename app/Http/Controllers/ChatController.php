<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\FAQQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function sendMessage(Request $request): JsonResponse
    {
        Log::info('=== CHAT MESSAGE RECEIVED ===');
        Log::info('Request data:', $request->all());
        
        try {
            $request->validate([
                'session_id' => 'required|string',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string|max:1000',
            ]);

            Log::info('Validation passed');

            // Save user message
            $userMessage = ChatMessage::create([
                'session_id' => $request->session_id,
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'type' => 'user',
                'status' => 'answered', // Always answered since bot responds
                'requires_admin' => false
            ]);

            Log::info('User message saved', ['message_id' => $userMessage->id]);

            // Find FAQ answer for EVERY question
            $faqAnswer = $this->findFAQAnswer($request->message);
            
            if ($faqAnswer) {
                Log::info('FAQ answer found', ['answer' => $faqAnswer]);
                
                $botMessage = ChatMessage::create([
                    'session_id' => $request->session_id,
                    'name' => 'ChatBot',
                    'email' => 'bot@chatbot.com',
                    'message' => $faqAnswer,
                    'type' => 'bot',
                    'status' => 'answered',
                    'requires_admin' => false
                ]);
            } else {
                Log::info('No FAQ answer found, providing generic response');
                
                // Provide a helpful generic response for every question
                $genericResponse = "Thank you for your question: \"{$request->message}\". I'm here to help! Please try asking about our business hours, shipping policies, contact information, or any other common topics. If you need specific assistance, feel free to rephrase your question.";
                
                $botMessage = ChatMessage::create([
                    'session_id' => $request->session_id,
                    'name' => 'ChatBot',
                    'email' => 'bot@chatbot.com',
                    'message' => $genericResponse,
                    'type' => 'bot',
                    'status' => 'answered',
                    'requires_admin' => false
                ]);
            }

            Log::info('Chat message processed successfully', [
                'user_message_id' => $userMessage->id,
                'bot_message_id' => $botMessage->id
            ]);

            return response()->json([
                'success' => true,
                'user_message' => $userMessage,
                'bot_message' => $botMessage
            ]);

        } catch (\Exception $e) {
            Log::error('Error processing chat message', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'An error occurred while processing your message: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getChatHistory(Request $request): JsonResponse
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

            Log::info('Chat history retrieved', [
                'session_id' => $sessionId,
                'message_count' => $messages->count()
            ]);

            return response()->json([
                'success' => true,
                'messages' => $messages
            ]);

        } catch (\Exception $e) {
            Log::error('Error retrieving chat history', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'An error occurred while retrieving chat history'
            ], 500);
        }
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

            Log::info('Users list retrieved', ['user_count' => $users->count()]);

            return response()->json([
                'success' => true,
                'users' => $users
            ]);

        } catch (\Exception $e) {
            Log::error('Error retrieving users list', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

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

            Log::info('User conversation retrieved', [
                'session_id' => $sessionId,
                'message_count' => $messages->count()
            ]);

            return response()->json([
                'success' => true,
                'user_info' => $userInfo,
                'messages' => $messages
            ]);

        } catch (\Exception $e) {
            Log::error('Error retrieving user conversation', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'An error occurred while retrieving user conversation'
            ], 500);
        }
    }

    private function findFAQAnswer(string $userMessage): ?string
    {
        try {
            $userMessage = strtolower(trim($userMessage));
            
            // Get all active FAQ questions
            $faqQuestions = FAQQuestion::where('is_active', true)->get();
            
            foreach ($faqQuestions as $faq) {
                if ($faq->matchesMessage($userMessage)) {
                    Log::info('FAQ match found', [
                        'user_message' => $userMessage,
                        'faq_question' => $faq->question,
                        'faq_answer' => $faq->answer
                    ]);
                    return $faq->answer;
                }
            }
            
            Log::info('No FAQ match found for message', ['user_message' => $userMessage]);
            return null;
            
        } catch (\Exception $e) {
            Log::error('Error finding FAQ answer', [
                'error' => $e->getMessage(),
                'user_message' => $userMessage
            ]);
            return null;
        }
    }
}
