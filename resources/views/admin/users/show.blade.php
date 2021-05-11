@extends('layout')
@section('content')
    <div class="card" style="margin-top: 20px">
        <div class="card-header">
            <i class="fas fa-user mr-1"></i>
            User Details
        </div>
        <div class="card-body">
            <h3>Name: {{ $user->name }}</h3>
                <h4>Email {{ $user->email }}</h4> <hr>
            <h4>Role:</h4>
            @if ($user->roles->isNotEmpty())
            @foreach ($user->roles as $role)
                <span class="badge badge-primary">
                    {{ $role->name }}
                </span>
            @endforeach
        @endif
            <h4>Permission: </h4>
            @if ($user->permissions->isNotEmpty())                                        
            @foreach ($user->permissions as $permission)
                <span class="badge badge-success">
                    {{ $permission->name }}                                    
                </span>
            @endforeach            
        @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">Back</a>
        </div>
    </div>
@endsection