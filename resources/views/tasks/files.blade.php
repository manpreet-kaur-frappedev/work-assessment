@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div class="content-wrapper">
	<div class="p-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <h4 class="p-2">Uploaded Files</h4>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h1>{{ $task->title }}</h1>
                        <h3>{{ $task->description }}</h3>
                        @foreach($files as $file)
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="row mt-3 border p-2">
                                    <div class="col-sm-9">
                                        <a href="{{ asset('files/' . $file->filename) }}" download>{{$file->filename}}</a>
                                    </div>
                                    <div class="col-sm-3 text-right">
                                        {{$file->created_at}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <form method="post" action="{{ route('tasks.uploadFile', $task->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="document">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-block bg-primary">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>

@endsection