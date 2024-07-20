@extends('layouts.app')

@section('title', 'Login')

@section('content')
    @component('components.form-card')
        @slot('title')
            Login
        @endslot

        <form action="{{ route('login') }}" method="post">
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
            <div>
                @foreach ($errors as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"
                    required>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Login</button>
        </form>
    @endcomponent
@endsection
