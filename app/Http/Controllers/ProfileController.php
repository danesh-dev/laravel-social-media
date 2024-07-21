<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{

    public function show($id)
    {
        // $profile = User::withCount(['posts', 'followers', 'followings'])->where('id', $id)->firstOrFail();
        // return response()->json($profile);
        // //todo show profile
        $user = User::findOrFail($id);
        $posts = Post::where("user_id", $id)->get();
        return view("user", compact("user", "posts"));
    }

    public function update(Request $request, $id)
    {
        $profile = User::findOrFail($id);

        Gate::authorize('update', $profile);
        $profile->update($request->all());

        return response()->json($profile);
    }

    public function destroy($id)
    {
        $profile = User::findOrFail($id);

        Gate::authorize('delete', $profile);

        $profile->delete();
    }
}
