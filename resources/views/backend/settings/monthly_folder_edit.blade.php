@extends('backend.app')

@section('title', 'Edit Monthly Folder')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Monthly Folder</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Monthly folder</li>
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
              <h3 class="box-title">Edit Folder</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ action('MonthlyFolderController@update', $folder->folder_id) }}" method="post" class="form-horizontal col-sm-offset-1">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="folder_name" class="col-sm-2 control-label">Folder name <span class="required">*</span></label>

                  <div class="col-sm-6">
                    <input type="text" name="folder_name" class="form-control" id="folder_name" value="{{ $folder->folder_name }}">
                    @if($errors->has('folder_name')) <span class="text-danger">{{ $errors->first('folder_name') }}</span> @endif
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