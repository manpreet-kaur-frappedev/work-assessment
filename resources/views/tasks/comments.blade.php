@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div class="content-wrapper">
	<div class="p-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <h4 class="p-2">Comments</h4>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h1>{{ $task->title }}</h1>
                        <h3>{{ $task->description }}</h3>
                        @foreach($comments as $comment)
                        <div class="row mt-3 border p-2">
                            <div class="col-sm-9">
                                {{$comment->comment}}
                            </div>
                            <div class="col-sm-3 text-right">
                                {{$comment->created_at}}
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