<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return view('home', compact('posts'));
    }

    public function create(){
        return view("new-post");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = [
            "title" => $request->title,
            "caption" => $request->caption,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
            // dd($imagePath);
        }

        $post = $request->user()->posts()->create($data);

        return redirect()->route("home")->with("success","Post created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        Gate::authorize("update", $post);

        $data = [
            "title" => $request->title,
            "caption" => $request->caption,
        ];

        $post->update($data);

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize("delete", $post);
        $post->delete();
    }

    public function userPosts($userId){
        $posts = Post::where("user_id", $userId)->get();
        return view("", compact(""));
    }
}
