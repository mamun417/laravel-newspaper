@extends('backend.app')

@section('title', 'Admin List')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="display: inline-block;">Admin</h1>
        @if(session()->has('successMsg'))
            <div class="alert alert-success alert-dismissable fade in custom-alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session('successMsg') }}
            </div>
        @endif
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admin</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Admin</h3>
                        <a href="{{ url('backend/admins/create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
                    </div>
                    <!-- /.box-header -->
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Designation</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $no => $admin)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $admin->full_name }}</td>
                                <td>{{ $admin->username }}</td>
                                <td>{{ $admin->designation }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->role }}</td>
                                <td>
                                    <a href="{{ action('AdminController@getChangePassword', $admin->id) }}" class="btn btn-warning btn-xs">
                                        <i class="fa fa-lock"></i>
                                    </a>
                                    <a href="{{ action('AdminController@edit', $admin->id) }}" class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <form action="{{ action('AdminController@destroy', $admin->id) }}" method="post" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this admin user?')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection