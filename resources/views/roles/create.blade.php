@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div class="content-wrapper">
	<div class="p-3">
        <div class="row py-lg-2">
            <div class="col-md-6">
                <h2>Create New Role</h2>
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="role_name">Role name</label>
                                <input type="text" name="role_name" class="form-control" id="role_name" placeholder="Role name..." required>
                            </div>
                            
                            <div class="form-group">
                                <label for="role_slug">Role Slug</label>
                                <input type="text" name="role_slug" class="form-control" id="role_slug" placeholder="Role Slug..." required>
                            </div>
                            
                            <div class="form-group">
                                <label for="roles_permissions">Add Permissions</label>
                                <div class="row">
                                    @foreach($permissions as $permission)
                                    <div class="col-sm-3 p-2">
                                        <div class="form-check custom-checkbox">
                                            <input class="form-check-input custom-control-input form-control" 
                                                type="checkbox" 
                                                name="selected_permissions[]" 
                                                value="{{ $permission->id }}" 
                                                id="{{ $permission->id }}">
                                            <label class="form-check-label custom-control-label" for="{{$permission->id}}">
                                                {{$permission->name}}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group pt-2">
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

@endsection