<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{chat}', function (Chat $chat) {
    return auth()->id() === $chat->user1_id ||  auth()->id()  === $chat->user2_id;
});
