@extends('backend.app')

@section('title', 'Upload Manual Document')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Manual Document</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manual Document</li>
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
              <h3 class="box-title">Upload Manual Document</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ action('ManualDocController@store') }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="manualDocument" class="col-sm-2 control-label">Choose Document</label>
                  <div class="col-sm-6">
                    <input type="file" name="manualDocument" id="manualDocument" class="form-control col-sm-6" style="height: auto">
                    @if($errors->has('manualDocument')) <span class="text-danger">{{ $errors->first('manualDocument') }}</span> @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-6">
	                <button type="submit" class="btn btn-info">Submit</button>
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