@extends('backend.app')

@section('title', 'Create Division')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Division</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Division</li>
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
              <h3 class="box-title">Create Division</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ action('DivisionController@store') }}" method="post" class="form-horizontal col-sm-offset-1">
            {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="division_name" class="col-sm-2 control-label">Division name <span class="required">*</span></label>

                  <div class="col-sm-6">
                    <input type="text" name="division_name" class="form-control" id="division_name" placeholder="Division name">
                    @if($errors->has('division_name')) <span class="text-danger">{{ $errors->first('division_name') }}</span> @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="division_name_bn" class="col-sm-2 control-label">Division name (Bn)</label>

                  <div class="col-sm-6">
                    <input type="text" name="division_name_bn" class="form-control" id="division_name_bn" placeholder="Division name bangla">
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