@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div class="content-wrapper">
	<div class="p-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h3 class="card-titles">Update Employee ({{$employee->name}})</h3>
                        <form action="{{ route('users.update', $employee->id) }}" id="create_emp" method="post">
                        	@csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="">Name</label>
                                <input name="name" id="emp_name" placeholder="Enter Your Name" type="text"
                                    class="form-control" value="{{ $employee->name }}">
	                            @if ($errors->has('name'))
	                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
	                            @endif
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="">Email</label>
                                <input name="email" id="emp_email" placeholder="Enter Your Email" type="email"
                                    class="form-control" value="{{ $employee->email }}">
	                            @if ($errors->has('email'))
	                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
	                            @endif
                            </div>
                            <div class="position-relative form-group">
                                <label for="examplePassword" class="">Password</label>
                                <input name="password" id="password" placeholder="Change Password"
                                    type="password" class="form-control">
	                            @if ($errors->has('password'))
	                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
	                            @endif
                            </div>
                            <div class="position-relative form-group">
                                <label for="examplePassword" class="">Select Roles</label>
                                <div class="row">
                                    @foreach($roles as $role)
                                    <div class="col-sm-3 p-2">
                                        <div class="form-check custom-checkbox">
                                            <input class="form-check-input custom-control-input form-control" 
                                                type="checkbox" 
                                                name="selected_roles[]" 
                                                value="{{ $role->id }}" 
                                                id="{{ $role->id }}">
                                            <label class="form-check-label custom-control-label" for="{{$role->id}}">
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <input type="hidden" value="employee" name="type">
                            <button type="submit" class="mt-1 btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

@endsection