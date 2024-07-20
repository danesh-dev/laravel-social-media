@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        @foreach ($posts as $post)
            <x-post :image="$post->image" :title="$post->title" :username="$post->user->username" :time="$post->created_at->diffForHumans()" :caption="$post->caption" />
        @endforeach
    </div>
@endsection
