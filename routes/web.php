<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;

Route::get('/', [PostController::class, 'index'])->name("home");


//auth
Route::get("/register", [AuthController::class, "showRegister"])->name("showRegister");
Route::get("/login", [AuthController::class, "showLogin"])->name("showLogin");
Route::post("/register", [AuthController::class, "register"])->name("register");
Route::post("/login", [AuthController::class, "login"])->name("login");

Route::middleware("auth")->group(function () {

    Route::get("/logout", [AuthController::class, "logout"]);

    //post
    Route::resource("/posts", PostController::class);

    //profile
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');
    Route::get('users/{user}', [ProfileController::class, 'show'])->name('profile.show');

    //follow
    Route::prefix('users/{user}')->group(function () {
        Route::post('/follow', [FollowerController::class, 'follow'])->name('follow');
        Route::delete('/unfollow', [FollowerController::class, 'unfollow'])->name('unfollow');
        Route::get('/followers', [FollowerController::class, 'followers']);
        Route::get('/followings', [FollowerController::class, 'followings']);
    });

    //chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{chat}', [MessageController::class, 'show'])->name('chat.show');
    Route::post('/chat/{chat}/messages', [MessageController::class, 'store'])->name('chat.messages.store');
    Route::post('/chat/create/{userId}', [ChatController::class, 'createChat'])->name('chat.create');

    //like
    Route::prefix("posts/{id}")->group(function () {
        Route::post("/likes", [LikeController::class, "store"]);
        Route::delete("/likes", [LikeController::class, "destroy"]);
    });
});
