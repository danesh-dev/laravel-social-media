<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::where("user_id", $id)->get();
        $isFollowed = $user->isFollowed();

        return view("profile", compact("user", "posts"));
        //todo count of posts, followers, followings
    }

    public function edit(){
        $user = User::findOrFail(Auth::user()->id);
        return view("profile-update", compact("user"));
    }

    public function update(UpdateUserRequest $request)
    {
        $user = User::findOrFail(auth()->id());
        $user->update($request->all());

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function destroy()
    {
        $user = User::findOrFail(auth()->id());
        $user->delete();

        return response()->json(['message' => 'Account deleted successfully.'], 200);
    }
}
