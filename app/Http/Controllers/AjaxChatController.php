<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // 🌟 Make sure User model import is present!
use App\Models\Message;
use App\Models\Conversation;
use Carbon\Carbon;
use Illuminate\Support\Str; // 🌟 CRITICAL: Missing this causes Str::limit to fail!

class AjaxChatController extends Controller
{
    // 🌟 1. The main view loader method you just provided
    public function showChat(Request $request)
    {
        // Get all staff members for the sidebar list
        $conversations = User::where('id', '!=', auth()->id())->get();

        $activeConversation = null;
        $activeUser = null;
        $historicalMessages = collect();

        // If a specific user was clicked in the sidebar
        if ($request->has('user_id')) {
            $activeUser = User::find($request->user_id);

            if ($activeUser) {
                // 🌟 IMPROVED: Look for an existing conversation room between these two users
                $activeConversation = Conversation::where(function($q) use ($request) {
                    $q->where('sender_id', auth()->id())->where('receiver_id', $request->user_id);
                })->orWhere(function($q) use ($request) {
                    $q->where('sender_id', $request->user_id)->where('receiver_id', auth()->id());
                })->first();

                // 🌟 NEW: If they've never chatted before, initialize a fresh room tuple record instantly!
                if (!$activeConversation) {
                    $activeConversation = Conversation::create([
                        'sender_id' => auth()->id(),
                        'receiver_id' => $activeUser->id,
                    ]);
                }

                // 🌟 ADDED AUTO-ERASE SAFETY NET HERE:
                // Since an active conversation room is loaded, wipe all unread notifications from the database right now!
                \DB::table('messages')
                    ->where('conversation_id', $activeConversation->id)
                    ->where('user_id', '!=', auth()->id()) // Only clear what OTHER people sent to you
                    ->where('is_read', 0)
                    ->update(['is_read' => 1]);

                // Pull the loaded message logs for this verified room
                $historicalMessages = Message::where('conversation_id', $activeConversation->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
            }
        }

        // Return your views with your variables exactly as they were
        return view('chat.index', compact('conversations', 'activeConversation', 'activeUser', 'historicalMessages'));
    }
    // 2. Save message to your existing table
    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'body' => 'required|string'
        ]);

        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'user_id' => $message->user_id,
                'body' => $message->body,
                'time' => Carbon::parse($message->created_at)->format('h:i A')
            ]
        ]);
    }

    // 3. Poll for rows created AFTER the last ID the browser loaded
   public function fetchNewMessages(Request $request)
{
    try {
        $conversationId = $request->query('conversation_id');
        $lastMessageId = $request->query('last_message_id', 0);

        if (!$conversationId) {
            return response()->json(['messages' => []]);
        }

        // 🌟 Safe Fetch: Pull messages sequentially using direct column IDs
        $messages = \App\Models\Message::where('conversation_id', $conversationId)
            ->where('id', '>', $lastMessageId)
            ->orderBy('id', 'asc')
            ->get();

        $formattedMessages = [];

        foreach ($messages as $msg) {
            // Manual user lookup to prevent relationship crashes
            $sender = \App\Models\User::find($msg->user_id);
            $senderName = $sender ? $sender->name : 'Workspace User';

            $formattedMessages[] = [
                'id' => $msg->id,
                'conversation_id' => $msg->conversation_id,
                'user_id' => $msg->user_id,
                'sender_name' => $senderName,
                'body' => $msg->body,
                // Safe Date Processing Fallback
                'time' => $msg->created_at ? $msg->created_at->format('h:i A') : date('h:i A')
            ];
        }

        return response()->json([
            'messages' => $formattedMessages
        ]);

    } catch (\Exception $e) {
        // Return an empty collection instead of printing raw PHP errors that crash JavaScript
        return response()->json([
            'messages' => [],
            'error' => 'Safe execution fallback activated'
        ]);
    }
}

    public function fetchUnreadNotifications()
    {
        try {
            $currentUserId = auth()->id();

            // 🌟 1. Target conversations where the current logged-in user is either the sender OR the receiver
            $myConversationIds = \App\Models\Conversation::where('sender_id', $currentUserId)
                ->orWhere('receiver_id', $currentUserId)
                ->pluck('id');

            // 🌟 2. Get incoming messages belonging to those rooms that WERE NOT sent by the current user AND are UNREAD
            $messages = \App\Models\Message::whereIn('conversation_id', $myConversationIds)
                ->where('user_id', '!=', $currentUserId)
                ->where('is_read', 0) // 👈 ONLY get unread messages!
                ->latest()
                ->take(5)
                ->get();

            $notifications = [];

            foreach ($messages as $msg) {
                $sender = \App\Models\User::find($msg->user_id);

                $notifications[] = [
                    'conversation_id' => $msg->conversation_id, // 🌟 Added this line so JavaScript can read it
                    'sender_id' => $msg->user_id,
                    'sender_name' => $sender ? $sender->name : 'Sender Account',
                    'body' => substr($msg->body, 0, 30) . (strlen($msg->body) > 30 ? '...' : ''),
                    'time' => $msg->created_at ? $msg->created_at->diffForHumans() : 'Just now'
                ];
            }

            return response()->json([
                'count' => count($notifications),
                'notifications' => $notifications
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'count' => 0,
                'notifications' => []
            ]);
        }
    }

    public function markAsRead(Request $request)
    {
        try {
            $conversationId = $request->input('conversation_id');
            $currentUserId = auth()->id();

            if ($conversationId) {
                // 🌟 FORCE raw database write to bypass any model fillable/guarded traps!
                \DB::table('messages')
                    ->where('conversation_id', $conversationId)
                    ->where('user_id', '!=', $currentUserId)
                    ->where('is_read', 0)
                    ->update(['is_read' => 1]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
