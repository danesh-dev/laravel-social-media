<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show($id)
    {
        $profile = User::with(['isFollowed'])->withCount(['posts', 'followers', 'followings'])->where('id', $id)->firstOrFail();
        return response()->json($profile);
    }

    public function update(Request $request, $id)
    {
        //todo
        // $profile = User::where('user_id', $id)->firstOrFail();
        // $profile->update($request->all());
        // return response()->json($profile);
    }

    public function destroy($id)
    {
        //todo check if auth->id == $id.
        $profile = User::find($id);
        $profile->delete();
    }
}
