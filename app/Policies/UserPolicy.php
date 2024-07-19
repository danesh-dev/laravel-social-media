<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $authUser, User $user): Response
    {
        return $authUser->id === $user->id ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $authUser, User $user): Response
    {
        return $authUser->id === $user->id ? Response::allow() : Response::denyAsNotFound();
    }

}
