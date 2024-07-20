<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
