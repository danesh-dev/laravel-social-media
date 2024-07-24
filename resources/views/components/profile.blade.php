@php
    $isFollowed = $user->followers()->where('follower_id', auth()->id())->exists();
@endphp

<div class="profile-card">
    <img src="https://via.placeholder.com/100" alt="Profile Image" class="profile-img mb-3">
    <h2 class="text-white">{{ '@' . $user->username }}</h2>
    <h4 class="text-secondary">{{ $user->name }}</h4>
    <p class="bio">{{ $user->bio }}</p>

    <div class="text-white">
        <span class="mx-1">Posts: {{ $user->posts_count }}</span>
        <span class="mx-1" id="followers-count">Followers: {{ $user->followers_count }}</span>
        <span class="mx-1">Followings: {{ $user->followings_count }}</span>
    </div>

    <div class="mt-3">
        @if ($user->id !== auth()->id())
            <button id="follow-unfollow-{{ $user->id }}"
                class="btn {{ $isFollowed ? 'btn-warning' : 'btn-primary' }}"
                onclick="toggleFollow({{ $user->id }})">
                {{ $isFollowed ? 'Unfollow' : 'Follow' }}
            </button>
            <button class="btn btn-success">Message</button>
        @else
            <a class="btn btn-warning" href="{{ route('profile.edit') }}">Edit</a>
        @endif
    </div>
</div>

@vite('resources/js/app.js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="module">
    const userId = '{{ $user->id }}';

    Echo.channel('user.' + userId)
        .listen('.UserFollowed', (e) => {
            followersCountElement.textContent = 'Followers: ' + e.followerCount;
        })
        .listen('.UserUnFollowed', (e) => {
            followersCountElement.textContent = 'Followers: ' + e.followerCount;

        });
</script>

<script>
    const userId = '{{ $user->id }}';
    const followUnfollowButton = document.getElementById(`follow-unfollow-${userId}`);
    const followersCountElement = document.getElementById('followers-count');

    function toggleFollow(userId) {
        const isFollowed = followUnfollowButton.classList.contains('btn-warning');
        const url = isFollowed ? `/users/${userId}/unfollow` : `/users/${userId}/follow`;
        const method = isFollowed ? 'DELETE' : 'POST';

        fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'followed') {
                    followUnfollowButton.classList.remove('btn-primary');
                    followUnfollowButton.classList.add('btn-warning');
                    followUnfollowButton.textContent = 'Unfollow';
                } else if (data.status === 'unfollowed') {
                    followUnfollowButton.classList.remove('btn-warning');
                    followUnfollowButton.classList.add('btn-primary');
                    followUnfollowButton.textContent = 'Follow';
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
