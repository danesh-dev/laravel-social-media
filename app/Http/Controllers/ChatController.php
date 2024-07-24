<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::where('user1_id', auth()->id())->orWhere('user2_id', auth()->id())->get();
        return view('chat', compact('chats'));
    }

    public function createChat($userId)
    {
        $authUserId = Auth::id();

        $chat = Chat::where(function ($query) use ($authUserId, $userId) {
            $query->where('user1_id', $authUserId)
                ->orWhere('user2_id', $authUserId);
        })->where(function ($query) use ($userId) {
            $query->where('user1_id', $userId)
                ->orWhere('user2_id', $userId);
        })->first();

        if (!$chat) {
            $chat = Chat::create([
                'user1_id' => $authUserId,
                'user2_id' => $userId
            ]);
        }

        return redirect()->route('chat.show', $chat->id);
    }
}
