@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Recent Post</div>
            <div class="card-body">
                <h5 class="card-title">Post Title</h5>
                <p class="card-text">Post Caption</p>
                <img src="path/to/image.jpg" alt="Post Image" class="img-fluid rounded">
                <div class="mt-3">
                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                    <a href="#"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
