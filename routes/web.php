<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('home');
})->name("home");


//auth
Route::get("/register", [AuthController::class, "showRegister"])->name("showRegister");
Route::get("/login", [AuthController::class, "showLogin"])->name("showLogin");
Route::post("/register", [AuthController::class, "register"])->name("register");
Route::post("/login", [AuthController::class, "login"])->name("login");
Route::get("/logout", [AuthController::class, "logout"])->middleware('auth');

Route::middleware("auth")->group(function () {
    Route::resource("/posts", PostController::class);
});

// Route::prefix("posts")->middleware('auth')->group(function () {
//     //like
//     Route::get("/{id}/likes", [LikeController::class, "index"]);
//     Route::post("/likes", [LikeController::class, "store"]);
//     Route::delete("/likes", [LikeController::class, "destroy"]);
// });

// Route::middleware('auth')->prefix('users/{user}')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'show']);
//     Route::put('/profile', [ProfileController::class, 'update']);
//     Route::delete('/profile', [ProfileController::class, 'destroy']);

//     Route::post('/follow', [FollowerController::class, 'follow']);
//     Route::post('/unfollow', [FollowerController::class, 'unfollow']);
//     Route::get('/followers', [FollowerController::class, 'followers']);
//     Route::get('/followings', [FollowerController::class, 'followings']);
// });
