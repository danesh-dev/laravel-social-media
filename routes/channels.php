<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    // return Chat::where('id', $chatId)->whereHas('users', function ($query) use ($user) {
    //     $query->where('id', $user->id);
    // })->exists();

    return $user->chats->contains($chatId);
    // return auth()->id() === $chat->user1_id ||  auth()->id()  === $chat->user2_id;
});
