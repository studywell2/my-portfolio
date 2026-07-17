<?php

namespace App\Http\Controllers;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class LiveChatController extends Controller
{
    private const TYPING_DURATION = 3; // seconds

    private const AUTO_RESPONSES = [
        "Thanks for reaching out! I'll get back to you as soon as possible. In the meantime, feel free to browse my projects.",
        "Great question! I'd love to discuss this further. Please use the contact form or email me for a detailed response.",
        "Hi there! Thanks for your message. I'm currently away but will respond shortly. Is there anything specific you'd like to know?",
        "I appreciate you reaching out! For project inquiries, feel free to use the cost calculator or contact form for a quicker response.",
        "Hello! Thanks for stopping by. I'll review your message and get back to you soon. Have a great day!",
    ];

    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'display_name' => 'nullable|string|max:50',
            'session_id' => 'required|string|max:100',
        ]);

        $conversation = ChatConversation::firstOrCreate(
            ['session_id' => $validated['session_id']],
            ['display_name' => $validated['display_name']],
        );

        if ($validated['display_name'] && $conversation->display_name !== $validated['display_name']) {
            $conversation->update(['display_name' => $validated['display_name']]);
        }

        $message = ChatMessage::create([
            'chat_conversation_id' => $conversation->id,
            'session_id' => $validated['session_id'],
            'display_name' => $validated['display_name'],
            'message' => $validated['message'],
            'is_from_visitor' => true,
        ]);

        $conversation->update([
            'typing_until' => now()->addSeconds(self::TYPING_DURATION),
            'auto_responded' => false,
            'last_activity_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'is_from_visitor' => true,
                'display_name' => $message->display_name,
                'created_at' => $message->created_at->toISOString(),
                'time' => $message->created_at->format('g:i A'),
            ],
        ]);
    }

    public function fetch(Request $request)
    {
        $request->validate([
            'session_id' => 'required|string|max:100',
            'after_id' => 'nullable|integer|min:0',
        ]);

        $sessionId = $request->input('session_id');
        $afterId = (int) $request->input('after_id', 0);

        $conversation = ChatConversation::where('session_id', $sessionId)->first();

        if (! $conversation) {
            return response()->json([
                'messages' => [],
                'is_typing' => false,
                'is_online' => true,
            ]);
        }

        $this->maybeGenerateAutoResponse($conversation);

        $messages = ChatMessage::where('chat_conversation_id', $conversation->id)
            ->where('id', '>', $afterId)
            ->orderBy('id')
            ->get()
            ->map(fn ($msg) => [
                'id' => $msg->id,
                'message' => $msg->message,
                'is_from_visitor' => $msg->is_from_visitor,
                'display_name' => $msg->display_name,
                'created_at' => $msg->created_at->toISOString(),
                'time' => $msg->created_at->format('g:i A'),
            ]);

        $isTyping = $conversation->typing_until
            && $conversation->typing_until->isFuture()
            && ! $conversation->auto_responded;

        return response()->json([
            'messages' => $messages,
            'is_typing' => $isTyping,
            'is_online' => true,
        ]);
    }

    public function status()
    {
        return response()->json(['is_online' => true]);
    }

    public function typing(Request $request)
    {
        $request->validate([
            'session_id' => 'required|string|max:100',
            'is_typing' => 'required|boolean',
        ]);

        $sessionId = $request->input('session_id');
        $isTyping = (bool) $request->input('is_typing');

        $conversation = ChatConversation::firstOrCreate(
            ['session_id' => $sessionId],
            ['display_name' => null]
        );

        $update = ['last_activity_at' => now()];

        if ($isTyping) {
            $update['typing_until'] = now()->addSeconds(self::TYPING_DURATION);
            // mark as not yet auto-responded while typing
            $update['auto_responded'] = false;
        } else {
            $update['typing_until'] = null;
        }

        $conversation->update($update);

        return response()->json(['success' => true]);
    }

    private function maybeGenerateAutoResponse(ChatConversation $conversation): void
    {
        if ($conversation->auto_responded) {
            return;
        }

        if (! $conversation->typing_until) {
            return;
        }

        if ($conversation->typing_until->isFuture()) {
            return;
        }

        $response = self::AUTO_RESPONSES[array_rand(self::AUTO_RESPONSES)];

        ChatMessage::create([
            'chat_conversation_id' => $conversation->id,
            'session_id' => $conversation->session_id,
            'display_name' => null,
            'message' => $response,
            'is_from_visitor' => false,
        ]);

        $conversation->update([
            'auto_responded' => true,
            'typing_until' => null,
            'last_activity_at' => now(),
        ]);
    }
}
