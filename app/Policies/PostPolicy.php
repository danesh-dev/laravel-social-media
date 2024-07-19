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
    public function update(User $user, Post $post): Response
    {
        return $user->id === $post->user_id ? Response::allow() : Response::denyAsNotFound();
    }

    public function delete(User $user, Post $post): Response
    {
        return $user->id === $post->user_id ? Response::allow() : Response::denyAsNotFound();
    }

}
