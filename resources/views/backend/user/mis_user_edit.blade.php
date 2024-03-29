@extends('backend.app')

@section('title', 'Edit MIS User')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>MIS User</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">MIS User</li>
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
              <h3 class="box-title">Edit MIS User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ action('MisUserController@update', $user->user_id) }}" method="post" class="form-horizontal col-sm-offset-1">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="user_type" class="col-sm-2 control-label">User Type</label>
                  <div class="col-sm-6">
                    <select class="form-control col-sm-6" name="user_type" id="user_type">
                      @foreach(config('customdata.user_types') as $key => $user_type)
                        <option value="{{ $key }}" {{ $key == $user->user_type ? 'selected' : '' }}>{{ $user_type }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="dept_type" class="col-sm-2 control-label">Dept. Type</label>
                  <div class="col-sm-6">
                    <select class="form-control col-sm-6" name="dept_type" id="dept_type">
                      @foreach(config('customdata.dept_types') as $key => $dept_type)
                        <option value="{{ $key }}" {{ $key == $user->dept_type ? 'selected' : '' }}>{{ $dept_type }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_name" class="col-sm-2 control-label">User Name <span class="required">*</span></label>
                  <div class="col-sm-6">
                    <input type="text" name="user_name" value="{{ $user->user_name }}" class="form-control" id="user_name" placeholder="User name">
                    @if($errors->has('user_name')) <span class="text-danger">{{ $errors->first('user_name') }}</span> @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_name_bn" class="col-sm-2 control-label">User Name (Bn)</label>
                  <div class="col-sm-6">
                    <input type="text" name="user_name_bn" value="{{ $user->user_name_bn }}" class="form-control" id="user_name_bn" placeholder="User name bangla">                   
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_initial" class="col-sm-2 control-label">User Initial <span class="required">*</span></label>
                  <div class="col-sm-6">
                    <input type="text" name="user_initial" value="{{ $user->user_initial }}" class="form-control" id="user_initial" placeholder="User initial">
                    @if($errors->has('user_initial')) <span class="text-danger">{{ $errors->first('user_initial') }}</span> @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_initial_bn" class="col-sm-2 control-label">User Initial (Bn)</label>
                  <div class="col-sm-6">
                    <input type="text" name="user_initial_bn" value="{{ $user->user_initial_bn }}" class="form-control" id="user_initial_bn" placeholder="User initial bangla">
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_bio" class="col-sm-2 control-label">User Bio</label>
                  <div class="col-sm-6">
                    <textarea name="user_bio" id="user_bio" class="form-control" placeholder="User biodata">{{ $user->user_bio }}</textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_bio_bn" class="col-sm-2 control-label">User Bio (Bn)</label>
                  <div class="col-sm-6">
                    <textarea name="user_bio_bn" id="user_bio_bn" class="form-control" placeholder="User biodata bangla">{{ $user->user_bio_bn }}</textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-6">
	                <button type="submit" class="btn btn-info">Update</button>
                    <a href="{{ url()->previous() }}" type="button" class="btn btn-default">Cancel</a>
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