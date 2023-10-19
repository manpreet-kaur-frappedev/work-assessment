@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div class="content-wrapper">
	<div class="p-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        @if(Auth::user()->type == 'employee')
                            <h3>Tasks</h3>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Deadline</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Auth::user()->tasks as $key => $task)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$task->title}}</td>
                                        <td>{{$task->description}}</td>
                                        <td><span class="badge badge-primary">{{$task->status}}</span></td>
                                        <td>{{$task->deadline}}</td>
                                        <td>
                                            <a href="{{ route('task.status', ['id' => $task->id, 'type' => 'start']) }}" class="badge badge-secondary">Start</a>
                                            <a href="{{ route('task.status', ['id' => $task->id, 'type' => 'finish']) }}" class="badge badge-secondary">Finish</a>
                                            <a href="{{ route('task.status', ['id' => $task->id, 'type' => 'discard']) }}" class="badge badge-secondary">Discard</a>
                                            <a href="{{ route('task.settings', $task->id) }}" class="badge badge-secondary">More Settings</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection