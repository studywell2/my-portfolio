<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use App\Models\ChatConversation;

use App\Http\Controllers\Controller;

class LiveChatAgentReplyController extends Controller
{
    /**
     * Store an admin/agent reply into the visitor conversation.
     */
    public function reply(Request $request)
    {
        $validated = $request->validate([
            'session_id' => 'required|string|max:100',
            'message' => 'required|string|max:1000',
        ]);

        $conversation = ChatConversation::firstOrCreate(
            ['session_id' => $validated['session_id']],
            ['display_name' => null]
        );

        ChatMessage::create([
            'chat_conversation_id' => $conversation->id,
            'session_id' => $validated['session_id'],
            'display_name' => null,
            'message' => $validated['message'],
            'is_from_visitor' => false,
        ]);

        $conversation->update([
            'typing_until' => null,
            'auto_responded' => false,
            'last_activity_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }
}


