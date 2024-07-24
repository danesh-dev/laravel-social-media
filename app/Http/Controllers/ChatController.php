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
        // $user2 = User::findOrFail($request->user_id);

        $chat = Chat::create([
            'user1_id' => Auth::id(),
            'user2_id' => $userId,
        ]);

        return redirect()->route('chat.index');
    }
}
