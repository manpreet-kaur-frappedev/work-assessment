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
                                            <a class="p-2" href="{{ route('users.edit', $employee->id) }}"><i class="fa fa-edit"></i></a>
                                            <a class="p-2" href="#" onclick="deleteEmployee({{ $employee->id }})"><i class="fas fa-trash-alt"></i></a>
                                            <a class="p-2" href="#" onclick="createNotificationForEmployee({{ $employee->id }})"><i class="fa fa-bell"></i></a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Notification for Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="employee_id" value="" id="employee_id">
                <input type="text" name="content" id="content" class="form-control" placeholder="Post a notification">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="sendNotification()">Apply</button>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function createNotificationForEmployee(employeeId) {
        $('#employee_id').val(employeeId);
        $('#exampleModal').modal()
    }

    function sendNotification() {
        var employeeId = $('#employee_id').val();
        var content = $('#content').val();

        $.ajax({
            type: 'post',
            url: '{{ route('notifications.applyNotification') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'employee_id': employeeId,
                'content': content
            },
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.error('An error occurred:', data);
            }
        });
    }


    function deleteEmployee(employeeId) {
        if (confirm('Are you sure you want to delete this employee?')) {
            $.ajax({
                type: 'DELETE',
                url: "{{ route('users.destroy', '') }}/" + employeeId,
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    // Handle success, such as refreshing the page or updating the UI.
                    // You may also want to redirect to a different page.
                    location.reload();
                },
                error: function (data) {
                    // Handle errors or show a message to the users.
                    console.error('An error occurred:', data);
                }
            });
        }
    }
</script>