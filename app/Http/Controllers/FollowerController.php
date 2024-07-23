<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\UserFollowed;
use Illuminate\Http\Request;
use App\Events\UserUnFollowed;

class FollowerController extends Controller
{
    public function follow($userId)
    {
        $user = User::findOrFail($userId);

        // if (!$user->isFollowed) {
            $follower = User::findOrFail(auth()->id());

            $follower->followings()->attach($userId);
            $followerCount = $user->followers()->count();

            event(new UserFollowed($user->id, $followerCount));

            return response()->json(['status' => 'followed']);
        // }
    }


    public function unfollow($userId)
    {
        $user = User::findOrFail($userId);

        if ($user->isFollowed) {
            $follower = User::findOrFail(auth()->id());

            $follower->followings()->detach($user->id);
            $followerCount = $user->followers()->count();

            event(new UserUnFollowed($user->id, $followerCount));


            return response()->json(['status' => 'unfollowed']);
        }
    }

    public function followers($userId)
    {
        $user = User::findOrFail($userId);
        $followers = $user->followers;

        return response()->json($followers);
        //todo return list
    }


    public function followings($userId)
    {
        $user = User::findOrFail($userId);
        $followings = $user->followings;

        return response()->json($followings);
        //todo
    }
}
