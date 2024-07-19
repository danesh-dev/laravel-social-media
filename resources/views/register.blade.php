@extends('layouts.app')

@section('title', 'Register')

@section('content')
    @component('components.form-card')
        @slot('title')
            Register
        @endslot

        <form>
            <div>
                @foreach ($errors as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
        </form>
    @endcomponent
@endsection
