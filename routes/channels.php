<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{chatId}', function (User $user, int $chatId) {

    return $user->chats->contains($chatId);
    // return auth()->id() === $chat->user1_id ||  auth()->id()  === $chat->user2_id;
});
