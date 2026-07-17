<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    protected $fillable = [
        'chat_conversation_id',
        'session_id',
        'display_name',
        'message',
        'is_from_visitor',
    ];

    protected $casts = [
        'is_from_visitor' => 'boolean',
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(ChatConversation::class);
    }
}
