@extends('backend.app')

@section('title', 'Ads Edit')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ $ads_heading }}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{ $ads_heading }} Edit</li>
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
                    <h3 class="box-title">{{ $ads_heading }} Edit</h3>
                </div>
                <!-- form start -->
                <form action="{{ action('AdsManagementController@update', $position) }}" method="post" class="form-horizontal col-sm-offset-1">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <div class="form-group">
                            <label for="tagName" class="col-sm-2 control-label">Code <span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="ads_code" class="form-control" id="tagName" value="{{ $ads->ads_code }}" placeholder="Ads code">
                                @if($errors->has('ads_code')) <span class="text-danger">{{ $errors->first('ads_code') }}</span> @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="startDate" class="col-sm-2 control-label">Start Date <span class="required">*</span></label></label>
                            <div class="col-sm-8">
                                <input type="date" name="start_date" value="{{ $ads->start_date }}" id="startDate" class="form-control">
                                @if($errors->has('start_date')) <span class="text-danger">{{ $errors->first('start_date') }}</span> @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="endDate" class="col-sm-2 control-label">End Date <span class="required">*</span></label></label>
                            <div class="col-sm-8">
                                <input type="date" name="end_date" id="end_date" value="{{ $ads->end_date }}" class="form-control">
                                @if($errors->has('end_date')) <span class="text-danger">{{ $errors->first('end_date') }}</span> @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ $ads->status == 1 ? 'checked' : '' }}>Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ $ads->status == 0 ? 'checked' : '' }}>Inactive
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <button type="submit" class="btn btn-info">Submit</button>
                                <button type="reset" class="btn btn-default">Clear</button>
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


@endsection    