<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_conversations', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique()->index();
            $table->string('display_name')->nullable();
            $table->timestamp('typing_until')->nullable();
            $table->boolean('auto_responded')->default(false);
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_conversations');
    }
};
