@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="p-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="main-card mb-3 card">     
                    <div class="card-header">
                        <h3>Name: {{$role['name']}}</h3>  
                        <h4>Slug: {{$role['slug']}}</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Permissions</h5>
                        <p class="card-text pt-4">
                            @foreach($role->permissions as $permission)
                                <h5><span class="badge badge-info">{{ $permission->name }}</span></h5>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection