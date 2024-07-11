<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can modify the post
     */
    public function modify(User $user, Post $post): Response
    {
        return $user->id === $post->user_id ? Response::allow() : Response::deny("You do not own this post");
    }


}
