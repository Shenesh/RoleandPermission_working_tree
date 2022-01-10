@extends('layout')
@section('content')
<div class="card" style="margin-top: 20px">
    <div class="card-header">
        <i class="fas fa-user-edit"></i>
        Edit user, ({{ $user->name }})
        <a href="" class="btn btn-primary btn-sm float-md-right">Create a new user</a>
    </div>
    <div class="card-body">
        <form action="/users/{{ $user->id }}" method="post">
            @method('PATCH')
            @csrf()
            
            <div>
                <div class="form-group">
                    <label for="">Name:</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name..." value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="">Email:</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="">Password:</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password..." minlength="8">
                    @if ($errors->has('password'))
                    <div style="color: red">
                        {{ $errors->first('password') }}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Password Confirm:</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password..." id="password_confirmation">
                </div>
                {{--  <div class="form-group">
                    <label for="">Select Role:</label>
            
                    <select name="role" id="role" class="form-control">
                        <option value="">Select a user role</option>
                        @foreach ($roles as $role)
                        
                            <option data-role-id="{{ $role->id }}" data-role-slug="{{ $role->slug }}" value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    
                </div>  --}}
                <div class="form-group">
                    <label for="role">Select Role</label>
                    <select class="role form-control" name="role" id="role">
                        <option value="">Select Role...</option>
                        @foreach ($roles as $role)
                            <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" 
                                value="{{$role->id}}" {{ $user->roles->isEmpty() || $role->name != $userRole->name ? "" : "selected"}}>{{$role->name}}</option>                
                        @endforeach
                    </select>          
                </div>
                <div class="form-group" id="permission_set">
                    
                    <label for="">Select Permissions:</label>
                    <div id="permission_check_box_list">

                    </div>

                </div>
                @if($user->permissions->isNotEmpty())
                @if($rolePermissions != null)
                    <div id="user_permissions_box" >
                        <label for="roles">User Permissions</label>
                        <div id="user_permissions_ckeckbox_list">                    
                            @foreach ($rolePermissions as $permission)
                            <div class="custom-control custom-checkbox">                         
                                <input class="custom-control-input" type="checkbox" name="permissions[]" id="{{$permission->slug}}" value="{{$permission->id}}" {{ in_array($permission->id, $userPermissions->pluck('id')->toArray() ) ? 'checked="checked"' : '' }}>
                                <label class="custom-control-label" for="{{$permission->slug}}">{{$permission->name}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            </div>
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
        var BASE = "{{url('/')}}/";
        var permisstion_set = $('#permission_set');
        permisstion_set.hide();
        var user_permission_box = $('#user_permissions_box');
        
        $('#role').on('change', function(){
            var role = $(this).find(':selected');
            var role_id = role.data('role-id');
            var role_slug = role.data('role-slug');
            //console.log(role_id);
            var params = {
                role_id : role.data('role-id'),
                role_slug : role.data('role-slug'),
                
            };
            $.ajax({
                url: BASE + 'users/create',
                method:'get',
                dataType:'json',
                data:$.param(params),
                success: function(response){
                    console.log(response.permissions);
                    alert('working');
                    user_permission_box.hide();
                    permisstion_set.show();
                    $(permission_check_box_list).empty();
                    $.each(response.permissions, function(index, element){
                        
                        $(permission_check_box_list).append(
                        '<div class="form-group">'+'<input class="" type="checkbox" name="permissions[]" id='+element.slug+' value='+element.id+' >' 
                            +'<lable class="" for='+element.slug+'>'+' '+element.name+'</lable>'
                            
                            +'</div>'
                            );
                            
                        });
                    }
                    
                });
                
                
            });
        });
</script>

@endsection


