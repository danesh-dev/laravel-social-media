@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="profile-card">
        <img src="path/to/profile-image.jpg" alt="Profile Image" class="profile-img mb-3">
        <h3 class="text-white">@username</h3>
        <p class="text-white">Full Name</p>
        <p class="bio">This is the user bio.</p>
        <button class="btn btn-primary">Follow</button>
        <button class="btn btn-danger">UnFollow</button>
        <button class="btn btn-secondary">Message</button>
    </div>
@endsection
