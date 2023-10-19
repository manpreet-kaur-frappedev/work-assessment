@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div class="content-wrapper">
	<div class="p-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h3 class="card-titles">Create Task</h3>
                        <form action="{{ route('task.store') }}" id="create_emp" method="post" enctype="multipart/form-data">
                        	@csrf
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="">Title</label>
                                <input name="title" id="emp_name" placeholder="Enter Your Title" type="text"
                                    class="form-control">
	                            @if ($errors->has('title'))
	                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
	                            @endif
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="">Description</label>
                                <input name="description" id="emp_email" placeholder="Enter Your Description" type="text" class="form-control">
	                            @if ($errors->has('description'))
	                                <span class="text-danger text-left">{{ $errors->first('description') }}</span>
	                            @endif
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="">Assign To</label>
                                <select class="form-control" name="assign_to">
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="">Status</label>
                                <select class="form-control" name="status">
                                    <option value="inactive">Inactive</option>
                                    <option value="start">Start</option>
                                    <option value="finish">Finish</option>
                                    <option value="discard">Discard</option>
                                </select>
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="">Deadline</label>
                                <input name="deadline" id="emp_email" placeholder="Enter Your deadline" type="datetime-local" class="form-control">
                                @if ($errors->has('deadline'))
                                    <span class="text-danger text-left">{{ $errors->first('deadline') }}</span>
                                @endif
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="">Upload Document</label>
                                <input name="document" type="file" class="form-control">
                            </div>
                            <button type="submit" class="mt-1 btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

@endsection