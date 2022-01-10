@extends('layout')
@section('content')

<div class="card" style="margin-top: 20px">


 

    <div class="card-header">
        <i class="fas fa-edit"></i>
        Edit post

        <div class="publish-checkbox" style="float: right" >
            <label for="publish-post">Publish Post </label>
            <input type="checkbox" name="publish-post" id="publish-post" {{ $post->published ? 'ckecked-checked':'' }}>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="body">body</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{$post->body}}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>


<script>


    $(document).ready(function(){    
        $('#publish-post').on('click', function(event) {
            // event.preventDefault();

            if ($("#publish-post").is(":checked")){
                var checked = 1;
            }else{
                var checked = 0;
            }
            $.ajax({
                url: "/post/{{$post->id}}",
                method: 'get',
                dataType: 'json',
                data: {
                    task: {
                        id: "{{$post->id}}",
                        checked: checked
                    }
                }
            }).done(function(data) {
                console.log(data);
            });
        });
        
    });
</script>
    @endsection
