<div class="profile-card">
    <img src="https://via.placeholder.com/100" alt="Profile Image" class="profile-img mb-3">
    <h2 class="text-white">{{ '@' . $user->username }}</h2>
    <h4 class="text-secondary">{{ $user->name }}</h4>
    <p class="bio">{{ $user->bio }}</p>
    <div class="mt-3">
        @if($user->id !== auth()->id())
            <button class="btn btn-primary mr-2">Follow</button>
            <button class="btn btn-success">Message</button>
        @else
            <a class="btn btn-warning" href="{{route("profile.edit")}}">Edit</a>
        @endif
    </div>
</div>

