@extends('layouts.app')

@section('title', 'Social Media')

@section('content')

    <x-profile :user="$user" />

    <div class="container">
        @foreach ($posts as $post)
            <x-post :post="$post" />
        @endforeach
    </div>

@endsection
