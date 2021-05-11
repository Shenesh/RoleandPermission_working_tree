@extends('layout')
@section('content')

<div class="card" style="margin-top: 20px">
    <div class="card-header">
        <i class="fas fa-user-edit"></i>
        Edit Role
    </div>
    <div class="card-body">
        <form action="{{ route('roles.update',$role->id) }}" method="post">
            @csrf
            @method('put')
            <div>
                <div class="form-group">
                    <label for="">Role:</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $role->name }}" autocomplete="nope">
                </div>
                <div class="form-group">
                    <label for="">Slug:</label>
                    <input type="text" name="slug" class="form-control" id="slug" value="{{ $role->slug }}">
                </div>
                <hr>
                <div class="form-group">
                    <label for="">Permissions:</label>
                    <input type="text" name="permissions" class="form-control" id="permission" value=" @foreach ($role->permissions as $permission)
                        {{ $permission->name."," }}
                    @endforeach" data-role="tagsinput">
                </div>
            
     
            </div>
    </div>
        <div class="card-footer">
            <div class="btn-group float-right" role="group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>  </form>
</div>  
<script>
    $(document).ready(function(){
        $('#name').keyup(function(e){
            var str = $('#name').val();
            str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
            $('#slug').val(str);
            $('$slug').attr('placeholder',str);
        });
    });
</script>
@endsection
