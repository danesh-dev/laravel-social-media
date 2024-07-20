@extends('layouts.app')

@section('title', 'Register')

@section('content')
    @component('components.form-card')
        @slot('title')
            Register
        @endslot

        <form action="{{ route('register') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <input type="text" class="form-control" id="bio" name="bio" placeholder="Enter your biography" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Register</button>
        </form>
    @endcomponent
@endsection
