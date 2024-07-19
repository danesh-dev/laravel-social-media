@extends('layouts.app')

@section('title', 'New Post')

@section('content')
    @component('components.form-card')
        @slot('title')
            New Post
        @endslot

        <form>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter post title">
            </div>
            <div class="form-group">
                <label for="caption">Caption</label>
                <textarea class="form-control" id="caption" rows="3" placeholder="Enter post caption"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    @endcomponent
@endsection
