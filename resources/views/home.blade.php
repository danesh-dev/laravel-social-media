@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        @foreach ($posts as $post)
            <x-post :post="$post" />
        @endforeach
    </div>
@endsection
