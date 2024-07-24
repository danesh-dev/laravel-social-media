<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{chat}', function ($user, Chat $chat) {
    return $user->id === $chat->user1_id || $user->id === $chat->user2_id;
});
