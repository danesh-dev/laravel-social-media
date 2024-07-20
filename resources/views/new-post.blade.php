@extends('layouts.app')

@section('title', 'New Post')

@section('content')
    @component('components.form-card')
        @slot('title')
            New Post
        @endslot

        <form action="/posts" method="POST" enctype="multipart/form-data">
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
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter post title">
            </div>
            <div class="form-group my-2">
                <label for="caption">Caption</label>
                <textarea class="form-control" id="caption" rows="3" name="caption" placeholder="Enter post caption"></textarea>
            </div>
            <div class="form-group my-3">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control-file" id="image">
            </div>
            <button type="submit" class="btn btn-primary btn-block d-grid gap-2 col-10 mx-auto mt-4">Submit</button>
        </form>
    @endcomponent
@endsection
