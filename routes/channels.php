<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{chat}', function (User $user, Chat $chat) {
    return $user->chats->contains($chat->id);
});
