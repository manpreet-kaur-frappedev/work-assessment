@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div class="content-wrapper">
	<div class="p-3">
        <div class="row py-lg-2">
            <div class="col-md-6">
                <h2>Roles</h2>
            </div>
            <div class="col-md-6">
                <a href="{{ route('roles.create') }}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Create New Role</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $key => $role)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            @foreach($role->permissions as $permission)
                                                <span class="badge badge-secondary">
                                                    {{$permission->name}}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('roles.show', $role->id) }}" class="px-2">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('roles.edit', $role->id) }}" class="px-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="deleteRole({{ $role->id }})" class="px-2">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

@endsection

<script>
    function deleteRole(roleId) {
        if (confirm('Are you sure you want to delete this role?')) {
            $.ajax({
                type: 'DELETE',
                url: '{{ route('roles.destroy', '') }}/' + roleId, // Append the role ID
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    location.reload(); // Refresh the page on success
                },
                error: function (data) {
                    console.error('An error occurred:', data);
                }
            });
        }
    }
</script>
