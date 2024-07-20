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
    public function store(LikeRequest $request)
    {
        $like = Like::where("user_id", auth('sanctum')->id())
            ->where("post_id", $request->post_id)->first();

        if (!$like) {
            $data = [
                "user_id" => auth('sanctum')->id(),
                "post_id" => $request->post_id,
            ];


            $like = Like::create($data);
        } else
            return response()->json(
                [
                    'message' => 'already liked'
                ],
                409
            );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeRequest $request)
    {
        $like = Like::where("user_id", auth('sanctum')->id())
            ->where("post_id", $request->post_id)->first();

        if ($like)
            $like->delete();
        else
            abort(404);
    }
}
