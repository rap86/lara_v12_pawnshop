<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // 🌟 Make sure User model import is present!
use App\Models\Message;
use App\Models\Conversation;
use Carbon\Carbon;

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

            // Pull the loaded message logs for this verified room
            $historicalMessages = Message::where('conversation_id', $activeConversation->id)
                ->orderBy('created_at', 'asc')
                ->get();
        }
    }

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
        $conversationId = $request->conversation_id;
        $lastMessageId = $request->last_message_id ?? 0;

        $newMessages = Message::where('conversation_id', $conversationId)
            ->where('id', '>', $lastMessageId)
            ->get()
            ->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'user_id' => $msg->user_id,
                    'body' => $msg->body,
                    'time' => Carbon::parse($msg->created_at)->format('h:i A')
                ];
            });

        return response()->json([
            'messages' => $newMessages
        ]);
    }
}
