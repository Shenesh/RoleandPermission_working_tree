@extends('layout')
@section('content')
<div class="card" style="margin-top: 20px">
    <div class="card-header">
        
            <i class="fas fa-text-width"></i>
            {{ strtoupper($post->title) }}
        
    </div>
    <div class="card-body">
        <label for="">Title</label>
        <input type="text" name="title" class="form-control" value="{{ $post->title }}" disabled >
        <label for="">Body</label>
        <textarea name="content" class="form-control" disabled>{{ $post->body }}</textarea>
    </div>
    <div class="card-footer">
        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>


</div>
@endsection
