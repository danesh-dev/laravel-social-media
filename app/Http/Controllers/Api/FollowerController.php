<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowerController extends Controller
{
    public function follow(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $follower = $request->user();

        if ($user->id === $follower->id) {
            return response()->json(['message' => 'You cannot follow yourself'], 400);
        }

        if ($follower->followings()->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'You are already following this user'], 409);
        }

        $follower->followings()->attach($userId);
        // $user->followers()->attach($follower->id);
        // $data = [
        //     "user_id" => $
        // ]

        return response()->json(['message' => 'Successfully followed the user'], 201);
    }


    public function unfollow(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $follower = $request->user();

        if (!$follower->followings()->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'You are not following this user'], 409);
        }

        $follower->followings()->detach($user->id);

        return response()->json(['message' => 'Successfully unfollowed the user'], 200);
    }

    public function followers($userId)
    {
        $user = User::findOrFail($userId);
        $followers = $user->followers;

        return response()->json($followers);
    }


    public function followings($userId)
    {
        $user = User::findOrFail($userId);
        $followings = $user->followings;

        return response()->json($followings);
    }
}
