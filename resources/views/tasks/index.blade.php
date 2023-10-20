@extends('layouts.app')
@section('title', 'Home Page')
@section('content')
<div class="content-wrapper">
    <section class="content p-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-titles">Tasks Listing</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Deadline</th>
                                        <th>Assignee</th>
                                        <th>Assigned To</th>
                                        <th>Status</th>
                                        <th>Action(s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $key => $task)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$task->title}}</td>
                                        <td>{{$task->description}}</td>
                                        <td>{{$task->deadline}}</td>
                                        <td>{{$task->assigneBy ? $task->assigneBy->name : ''}}</td>
                                        <td>{{$task->assignTo ? $task->assignTo->name : ''}}</td>
                                        <td>
                                            @if($task->status == 'inactive')
                                                <span class="p-2 badge badge-light">Inactive</span>
                                            @elseif($task->status == 'start')
                                                <span class="p-2 badge badge-success">Started</span>
                                            @elseif($task->status == 'finish')
                                                <span class="p-2 badge badge-primary">Finished</span>
                                            @elseif($task->status == 'discard')
                                                <span class="p-2 badge badge-danger">Discarded</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- <a href="{{ route('tasks.comments', $task->id) }}" class="p-2">
                                                <i class="fa fa-comment"></i>
                                            </a>
                                            <a href="{{ route('tasks.uploadedFiles', $task->id) }}" class="p-2">
                                                <i class="fa fa-file"></i>
                                            </a> -->
                                            <a href="{{ route('task.status', ['id' => $task->id, 'type' => 'start']) }}" title="Click to Start" class="badge badge-success"><i class="fa fa-play"></i> Start</a>
                                            <a href="{{ route('task.status', ['id' => $task->id, 'type' => 'finish']) }}" title="Click to Finish" class="badge badge-primary"><i class="fa fa-circle"></i> Finish</a>
                                            <a href="{{ route('task.status', ['id' => $task->id, 'type' => 'discard']) }}" title="Click to Discard" class="badge badge-danger"><i class="fa fa-times"></i> Discard</a>
                                            <a href="{{ route('tasks.comments', $task->id) }}" class="badge badge-dark" title="Click to view Comments"><i class="fa fa-comments"></i> Comments</a>
                                            <a href="{{ route('tasks.uploadedFiles', $task->id) }}" class="badge badge-dark" title="Click to view Uploads"><i class="fa fa-upload"></i> Uploads</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection