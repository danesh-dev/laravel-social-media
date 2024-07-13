<?php

namespace App\Policies;

use App\Http\Requests\LikeRequest;
use App\Models\Like;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Access\Response;

class ProfilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function updateOrDelete(User $user, $userId): Response
    {
        return auth('sanctum')->id() === $userId ? Response::allow() : Response::deny("You do not have permission",403);
    }


}
