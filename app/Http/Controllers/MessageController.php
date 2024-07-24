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

        $messages = $chat->messages()->with('user')->get();

        return response()->json($messages);
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
