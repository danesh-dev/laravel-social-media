<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;

//authentication user
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"])->middleware('auth:sanctum');


Route::prefix("posts")->group(function () {
    Route::apiResource("/", PostController::class);

    //like
    Route::get("/{id}/likes", [LikeController::class,"index"]);
    Route::post("/likes", [LikeController::class,"store"]);
    Route::delete("/likes", [LikeController::class,"destroy"]);

});
