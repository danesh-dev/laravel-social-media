@php
    $contact = $chat->user1_id === auth()->id() ? $chat->user2 : $chat->user1;
    $lastMsg = $chat->messages()->latest()->first();
@endphp

<a class="msg text-decoration-none" href="{{route('chat.show', $chat->id)}}">
    <img class="msg-profile"
        src="{{asset('img/images.png')}}"
        alt="" class="account-profile" alt="">
    <div class="msg-detail text-decoration-none">
        <div class="msg-username">{{ $contact->name }}</div>
        <div class="msg-content">
            @if ($lastMsg != null)
                <span class="msg-message">{{ $lastMsg->message }}</span>
                <span class="msg-date">{{ $lastMsg->created_at->diffForHumans() }}</span>
            @endif
        </div>
    </div>
</a>
