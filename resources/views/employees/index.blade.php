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
                            <h3 class="card-titles">Employees Listing</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Permissions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $key => $employee)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$employee->name}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td>
                                            @foreach($employee->roles as $role)
                                                <span class="badge badge-secondary">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($employee->permissions as $permission)
                                                <span class="badge badge-secondary">
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('employee.edit', $employee->id) }}"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('employee.destroy', $employee->id) }}"><i class="fas fa-trash-alt"></i></a>
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