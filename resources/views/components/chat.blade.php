@php
    $contact = $chat->user1_id === auth()->id() ? $chat->user2 : $chat->user1;
    $lastMsg = $chat->messages()->latest()->first();
@endphp

<a class="msg text-decoration-none" href="{{ route('chat.show', $chat->id) }}">
    @if (empty($contact->image))
        <img class="user-profile" src="{{ asset('img/images.png') }}" alt="" class="user-profile" alt="">
    @else
        <img src="{{ asset('storage/' . $contact->image) }}" alt="Profile Image" class="user-profile" >
    @endif
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
