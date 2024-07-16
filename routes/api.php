<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\FollowerController;

//user authentication
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"])->middleware('auth:sanctum');

Route::apiResource("/posts", PostController::class)->middleware("auth:sanctum");

Route::prefix("posts")->group(function () {
    //like
    Route::get("/{id}/likes", [LikeController::class, "index"]);
    Route::post("/likes", [LikeController::class, "store"]);
    Route::delete("/likes", [LikeController::class, "destroy"]);
});

Route::middleware('auth:sanctum')->prefix('users/{user}')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    Route::post('/follow', [FollowerController::class, 'follow']);
    Route::post('/unfollow', [FollowerController::class, 'unfollow']);
    Route::get('/followers', [FollowerController::class, 'followers']);
    Route::get('/followings', [FollowerController::class, 'followings']);
});
