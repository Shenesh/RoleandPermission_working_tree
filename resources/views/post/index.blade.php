@extends('layout')
@section('content')
    <div class="card" style="margin-top: 20px" > 
        <div class="card-header">
            Post Index
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Created by</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}}</td>
                        <td>{{$post->user()->first()->name}}</td>
                        <td>
                            <a href="{{route('post.show',$post->id)}}" class="btn btn-primary">Show</a>
                            @can('edit',$post)
                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-success">Edit</a>
                            @endcan 
                            <form action="{{route('post.destroy',$post->id)}}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection