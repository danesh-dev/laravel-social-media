@extends('layouts.app')

@section('title', 'Login')

@section('content')
    @component('components.form-card')
        @slot('title')
            Login
        @endslot

        <form>
            <div>
                @foreach ($errors as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    @endcomponent
@endsection
