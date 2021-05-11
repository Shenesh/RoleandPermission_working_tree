@extends('layout')
@section('content')
<div class="card" style="margin-top: 20px">
    <div class="card-header">
        <i class="fas fa-user mr-1"></i>
        Role Details
    </div>
    <div class="card-body">
        <h4>Role: {{ $role->name }}</h4>
            <h5>Slug: {{ $role->slug }}</h5> <hr>
        
        <h5>Permissions: </h5>
    </div>
    <div class="card-footer">
        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary">Back</a>
    </div>
</div>
@endsection