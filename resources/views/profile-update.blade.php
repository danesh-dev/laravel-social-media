@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="container mt-5 col-8">
        <div class="card shadow-lg p-4">
            <h3 class="text-center text-light mb-4">Edit Account</h3>
            <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="form-group mt-1">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', auth()->user()->name) }}">
                </div>
                <div class="form-group mt-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="{{ old('username', auth()->user()->username) }}">
                </div>
                <div class="form-group mt-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', auth()->user()->email) }}">
                </div>
                <div class="form-group mt-3">
                    <label for="bio">Bio</label>
                    <textarea class="form-control" id="bio" name="bio">{{ old('bio', auth()->user()->bio) }}</textarea>
                </div>
                <div class="row position-relative col-10 mx-auto mt-4">
                    <button type="submit" class="btn btn-primary mt-3 d-grid gap-2" id="saveChangesBtn" disabled>Save
                        Changes</button>
                </div>
            </form>
            <button class="btn btn-danger col-10 mx-auto" id="deleteAccountBtn" onclick="deleteAccount()">Delete
                Account</button>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const originalValues = {
            name: document.getElementById('name').value,
            username: document.getElementById('username').value,
            email: document.getElementById('email').value,
            bio: document.getElementById('bio').value
        };

        const profileForm = document.getElementById('profileForm');
        const saveChangesBtn = document.getElementById('saveChangesBtn');

        profileForm.addEventListener('input', function() {
            const currentValues = {
                name: document.getElementById('name').value,
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                bio: document.getElementById('bio').value
            };

            const valuesChanged = Object.keys(originalValues).some(key => originalValues[key] !==
                currentValues[key]);

            saveChangesBtn.disabled = !valuesChanged;
        });

        window.deleteAccount = function() {
            if (confirm('Do you really want to delete your account?')) {
                $.ajax({
                    url: '{{ route('profile.delete') }}',
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        alert('Your account has been deleted.');
                        window.location.href = '/';
                    },
                    error: function(xhr, status, error) {
                        alert('There was an error deleting your account: ' + error);
                    }
                });
            }
        };
    });
</script>
