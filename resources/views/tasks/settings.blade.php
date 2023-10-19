@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div class="content-wrapper">
	<div class="p-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h2>{{ $task->title }}</h2>
                        <p>{{ $task->description }}</p>

                        <form method="post" action="{{ route('task.saveSettings', $task->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="exampleEmail" class="">Add Comment</label>
                                    <input name="comment" placeholder="Add Comment" type="text" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label for="exampleEmail" class="">Upload File</label>
                                    <input name="document" type="file" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Save</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mt-3 mb-3 text-center">Previous Comments</h4>
                        @foreach($task->comments($task->id) as $key => $comment)
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="h5">
                                            {{$comment->comment}}
                                        </div>
                                    </div>
                                    <div class="col-sm-3 text-right">
                                        <small>
                                            {{$comment->created_at}}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-sm-6">
                        <h4 class="mt-3 mb-3 text-center">Uploaded Files</h4>
                        @foreach($task->files($task->id) as $key => $files)
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="h5">
                                                <div class="text-left">
                                                    <a href="{{ asset('files/' . $files->filename) }}" download>{{$files->filename}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <small>
                                                {{$files->created_at}}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection