<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChatPolicy
{
    public function view(User $user, Chat $chat)
    {
        return $user->id === $chat->user1_id || $user->id === $chat->user2_id;
    }
}
