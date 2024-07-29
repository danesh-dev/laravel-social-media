@extends('layouts.app')

@section('title', 'Chat')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <div class="app my-3">
        <div class="header">
            <div class="logo">
                <svg viewBox="0 0 513 513" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M256.025.05C117.67-2.678 3.184 107.038.025 245.383a240.703 240.703 0 0085.333 182.613v73.387c0 5.891 4.776 10.667 10.667 10.667a10.67 10.67 0 005.653-1.621l59.456-37.141a264.142 264.142 0 0094.891 17.429c138.355 2.728 252.841-106.988 256-245.333C508.866 107.038 394.38-2.678 256.025.05z" />
                    <path
                        d="M330.518 131.099l-213.825 130.08c-7.387 4.494-5.74 15.711 2.656 17.97l72.009 19.374a9.88 9.88 0 007.703-1.094l32.882-20.003-10.113 37.136a9.88 9.88 0 001.083 7.704l38.561 63.826c4.488 7.427 15.726 5.936 18.003-2.425l65.764-241.49c2.337-8.582-7.092-15.72-14.723-11.078zM266.44 356.177l-24.415-40.411 15.544-57.074c2.336-8.581-7.093-15.719-14.723-11.078l-50.536 30.744-45.592-12.266L319.616 160.91 266.44 356.177z"
                        fill="#fff" />
                </svg>
            </div>
            <div class="user-settings">
                <div class="dark-light">
                    <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>
                </div>
                @if (isset($friend))
                    <a class="my-auto text-decoration-none"
                        href="{{ route('profile.show', $friend->id) }}">{{ $friend->name }}</a>
                    @if (empty($friend->image))
                        <img class="user-profile" src="{{ asset('img/images.png') }}" alt=""
                            class="account-profile"alt="">
                    @else
                        <img src="{{ asset('storage/' . $friend->image) }}" alt="Profile Image" class="user-profile">
                    @endif

                @endif
            </div>
        </div>
        <div class="wrapper">
            <div class="conversation-area">

                @foreach ($chats as $chat)
                    <x-chat :chat="$chat" />
                @endforeach

                {{-- <button class="add"></button> --}}
                <div class="overlay"></div>
            </div>

            <div class="chat-area">
                <div class="chat-area-main mt-3">
                    @if (isset($messages))
                        @forelse ($messages as $message)
                            @if ($message->user_id == auth()->id())
                                <x-message-owner :message="$message" />
                            @else
                                <x-message :message="$message" />
                            @endif

                        @empty
                        @endforelse
                    @endif

                </div>
                @if (isset($messages))
                    <div class="chat-area-footer">
                        <input type="text" placeholder="Type something here..." id="message-input" />

                        <button id="send-btn" class="btn btn-primary btn-lg rounded-2 " disabled> <i
                                class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        {{-- <button class="btn btn-primary" id="send-btn">send</button> --}}
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script src="{{ asset('js/chat.js') }}"></script>
@endsection

@vite('resources/js/app.js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="module">
    let url = window.location.href;
    let urlParts = url.split('/');
    let chatId = urlParts[urlParts.length - 1];

    Echo.channel('chat.' + chatId)
        .listen('.MessageSent', (e) => {
            appendMessage(e.message);
        });

    function appendMessage(message) {
        let messageHtml = `
            <div class="chat-msg ${message.user_id == {{ auth()->id() }} ? 'owner' : ''}">
                <div class="chat-msg-profile">
                    <div class="chat-msg-date">${new Date(message.created_at).toLocaleTimeString()}</div>
                </div>
                <div class="chat-msg-content">
                    <div class="chat-msg-text">
                        ${message.message}
                    </div>
                </div>
            </div>`;
        $('.chat-area-main').append(messageHtml);

        scrollToBottom();
    }

    function scrollToBottom() {
        let chatAreaMain = $('.chat-area-main');
        // chatAreaMain.scrollTop(chatAreaMain.prop("scrollHeight"));
        chatAreaMain.scrollTop = chatAreaMain.scrollHeight;
    }

    scrollToBottom();
</script>

<script>
    $(document).ready(function() {
        let url = window.location.href;
        let urlParts = url.split('/');
        let chatId = urlParts[urlParts.length - 1];

        $('#message-input').on('input', function() {
            if ($.trim($(this).val()) !== '') {
                $('#send-btn').removeAttr('disabled');
            } else {
                $('#send-btn').attr('disabled', true);
            }
        });

        $('#send-btn').on('click', function() {
            let message = $('#message-input').val();

            $.ajax({
                url: '/chat/' + chatId + '/messages',
                method: 'POST',
                data: {
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#message-input').val('');
                    // Append message to chat interface
                }
            });
        });

    });
</script>
