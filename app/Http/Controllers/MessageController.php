<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{
    public function show(Chat $chat)
    {
        Gate::authorize('view', $chat);
        $friend = $chat->user1_id === auth()->id() ? $chat->user2 : $chat->user1;

        $chats = Chat::where('user1_id', auth()->id())->orWhere('user2_id', auth()->id())->get();
        $messages = $chat->messages()->with('user')->get();

        return view('chat', compact('messages', 'chats', 'friend'));
    }

    public function store(Request $request, Chat $chat)
    {
        Gate::authorize('view', $chat);

        $message = $chat->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message, 201);
    }
}
