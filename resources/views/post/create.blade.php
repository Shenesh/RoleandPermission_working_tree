@extends('layout')
@section('content')
    <div class="card"   style="margin-top: 20px">
        <div class="card-header"> Create a post </div>
        <div class="card-body">
            <form action="{{route('post.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection