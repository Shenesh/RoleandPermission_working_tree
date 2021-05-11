@extends('layout')
@section('content')
<div class="card" style="margin-top: 20px">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Role Table
    </div>
    <div class="card-body">
        <table id="" class="display compact row-border stripe" style="width:100%">
            <thead><tr><th>Role Name</th><th>Slug</th><th>Permission</th><th>Action</th></tr>
            </thead>
            @foreach ($roles as $role)
              <tr>  <td>{{ $role->name }}</td><td>{{ $role->slug }}</td> <td> @if ($role->permissions !=null)
                  @foreach ($role->permissions as $permission)
                      <span class="badge badge-dark">
                          {{ $permission->name }}
                      </span>
                  @endforeach
                  
              @endif</td>
                
            <td>
                <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                    <a class="btn btn-sm btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                    <a class="btn btn-sm btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>

                @csrf
                @method('DELETE')
  
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              
            </form>
            </td></tr>
            @endforeach
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection