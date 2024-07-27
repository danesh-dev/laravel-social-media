<div class="chat-msg">
    <div class="chat-msg-profile">
        <div class="chat-msg-date">{{ $message->formatted_time }}</div>
    </div>
    <div class="chat-msg-content">
        <div class="chat-msg-text">
            {{ $message->message }}
        </div>
    </div>
</div>
