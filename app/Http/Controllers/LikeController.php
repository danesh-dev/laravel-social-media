<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Requests\LikeRequest;
use App\Http\Resources\LikeResource;

class LikeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        return LikeResource::collection(Like::where("post_id", $id)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {

        $data = [
            "user_id" => auth()->id(),
            "post_id" => $id,
        ];

        $like = Like::create($data);

        return response()->json(['status' => 'liked']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $like = Like::where("user_id", auth('sanctum')->id())
            ->where("post_id", $id)->first();

        if ($like) {
            $like->delete();
            return response()->json(['status' => 'unliked']);
        } else
            abort(404);
    }
}
