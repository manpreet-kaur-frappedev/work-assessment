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
                                                <span class="p-2 badge badge-primary">Inactive</span>
                                            @elseif($task->status == 'start')
                                                <span class="p-2 badge badge-primary">Start</span>
                                            @elseif($task->status == 'finish')
                                                <span class="p-2 badge badge-primary">Finish</span>
                                            @elseif($task->status == 'discard')
                                                <span class="p-2 badge badge-primary">Discard</span>
                                            @endif
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