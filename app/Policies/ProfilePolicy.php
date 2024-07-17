<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProfilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(User $user): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can view the model.
     */
    // public function view(User $user, User $model): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can create models.
     */
    // public function create(User $user): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can update the model.
     */
    public function update(int $userId): Response
    {
        return auth('sanctum')->id() === $userId ? Response::allow() : Response::deny("You do not have permission",403);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(int $userId): Response
    {
        return auth('sanctum')->id() === $userId ? Response::allow() : Response::deny("You do not have permission",403);
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, User $model): bool
    // {

    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, User $model): bool
    // {
    //     //
    // }
}
