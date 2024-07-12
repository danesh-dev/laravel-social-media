<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\LikeRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class LikeController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware("auth:sanctum")
        ];
    }

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
