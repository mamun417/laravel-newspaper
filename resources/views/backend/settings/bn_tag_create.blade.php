@extends('backend.app')

@section('title', 'Bn Tag Insert')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Bn Tag</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bn Tag</li>
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
              <h3 class="box-title">Bn Tag Insert</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ action('BnTagController@store') }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
            {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="tagType" class="col-sm-2 control-label">Tag type</label>
                  <div class="col-sm-8">
                    <select class="form-control col-sm-6" name="tagType" id="tagType">
                      @foreach(config('customdata.tag_types') as $key => $tag_type)
                        <option value="{{ $key }}">{{ $tag_type }}</option>
                      @endforeach
                  	</select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tagName" class="col-sm-2 control-label">Tag name Bn <span class="required">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="tagName" class="form-control" id="tagName" placeholder="Tag name">
                    @if($errors->has('tagName')) <span class="text-danger">{{ $errors->first('tagName') }}</span> @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="tagSlug" class="col-sm-2 control-label">Tag slug <span class="required">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="tagSlug" class="form-control" id="tagSlug" placeholder="Tag slug">
                    @if($errors->has('tagSlug')) <span class="text-danger">{{ $errors->first('tagSlug') }}</span> @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="tagDescription" class="col-sm-2 control-label">Tag Description Bn</label>
                  <div class="col-sm-8">
                    <textarea name="tagDescription" id="tagDescription" class="form-control" placeholder="Tag description"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tagPhoto" class="col-sm-2 control-label">Choose Photo</label>
                  <div class="col-sm-8">
                    <input type="file" name="tagPhoto" id="tagPhoto" class="form-control col-sm-6" style="height: auto">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Approval</label>
                  <div class="col-sm-8">
                    <label class="radio-inline">
                      <input type="radio" name="approval" value="1" checked>Active
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="approval" value="2">Inactive
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-8">
	                <button type="submit" class="btn btn-info">Submit</button>
	                <a href="{{ route('bn-tags.index') }}" type="button" class="btn btn-default">Cancel</a>
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