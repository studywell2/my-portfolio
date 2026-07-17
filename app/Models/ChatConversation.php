<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatConversation extends Model
{
    protected $fillable = [
        'session_id',
        'display_name',
        'typing_until',
        'auto_responded',
        'last_activity_at',
    ];

    protected $casts = [
        'typing_until' => 'datetime',
        'auto_responded' => 'boolean',
        'last_activity_at' => 'datetime',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function visitorMessages(): HasMany
    {
        return $this->messages()->where('is_from_visitor', true);
    }

    public function agentMessages(): HasMany
    {
        return $this->messages()->where('is_from_visitor', false);
    }
}
