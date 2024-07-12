<?php

namespace App\Policies;

use App\Http\Requests\LikeRequest;
use App\Models\Like;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LikePolicy
{
    /**
     * Create a new policy instance.
     */
    public function modify(User $user, LikeRequest $like): Response
    {
        return $user->id === $like->user_id ? Response::allow() : Response::deny("You do not have permission ");
    }
}
