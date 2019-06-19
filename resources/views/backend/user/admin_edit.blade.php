@extends('backend.app')

@section('title', 'Edit Admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Admin</h1>
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
                        <h3 class="box-title">Edit Admin</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ action('AdminController@update', $admin->id) }}" method="post" class="form-horizontal col-sm-offset-1">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Full Name <span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $admin->name }}" placeholder="Full name">
                                    @if($errors->has('name')) <span class="text-danger">{{ $errors->first('name') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="designation" class="col-sm-2 control-label">Designation <span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="designation" class="form-control" id="designation" value="{{ $admin->designation }}" placeholder="Designation">
                                    @if($errors->has('designation')) <span class="text-danger">{{ $errors->first('designation') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email <span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <input type="email" name="email" class="form-control" id="email" value="{{ $admin->email }}" placeholder="Email">
                                    @if($errors->has('email')) <span class="text-danger">{{ $errors->first('email') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username <span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="username" class="form-control" id="username" value="{{ $admin->username }}" placeholder="Username">
                                    @if($errors->has('username')) <span class="text-danger">{{ $errors->first('username') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role" class="col-sm-2 control-label">Role</label>
                                <div class="col-sm-6">
                                    <select class="form-control col-sm-6" name="role" id="role">
                                        @foreach(config('customdata.user_roles') as $key => $role)
                                            <option value="{{ $key }}" {{ $admin->role == $key ? 'selected' : '' }}>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-info">Update</button>
                                    <button type="submit" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection