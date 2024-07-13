<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function show($id)
    {
        $profile = User::withCount(['posts', 'followers', 'followings'])->where('id', $id)->firstOrFail();
        return response()->json($profile);
    }

    public function update(Request $request, $id)
    {
        // Gate::authorize("updateOrDelete", $id);
        $profile = User::findOrFail($id);
        $profile->update($request->all());

        return response()->json($profile);
    }

    public function destroy($id)
    {
        // Gate::authorize("updateOrDelete", $id);
        $profile = User::find($id);

        $profile->delete();
    }
}
