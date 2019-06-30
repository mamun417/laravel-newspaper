@extends('backend.app')

@section('title', 'Top Ads')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ $ads_heading }}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{ $ads_heading }}</li>
        </ol>
    </section>

    @if($ads->count() == 0)
        <!-- Add ads -->
        <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $ads_heading }} Insert</h3>
                    </div>
                    <!-- form start -->
                    <form action="{{ action('AdsManagementController@store', $ads_position) }}" method="post" class="form-horizontal col-sm-offset-1">
                        {{ csrf_field() }}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="tagName" class="col-sm-2 control-label">Code <span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <textarea name="ads_code" class="form-control" id="tagName" placeholder="Ads code" rows="5">{{ old('ads_code') }}</textarea>
                                    @if($errors->has('ads_code')) <span class="text-danger">{{ $errors->first('ads_code') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="startDate" class="col-sm-2 control-label">Start Date <span class="required">*</span></label></label>
                                <div class="col-sm-8">
                                    <input type="date" name="start_date" value="{{ old('start_date') }}" id="startDate" class="form-control">
                                    @if($errors->has('start_date')) <span class="text-danger">{{ $errors->first('start_date') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="endDate" class="col-sm-2 control-label">End Date <span class="required">*</span></label></label>
                                <div class="col-sm-8">
                                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="form-control">
                                    @if($errors->has('end_date')) <span class="text-danger">{{ $errors->first('end_date') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" checked>Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0">Inactive
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
    @else
        <!-- Ad List -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">List of {{ $ads_heading }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ads Code</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ads as $ad)
                                <tr>
                                    <td>{{ $ad->id }}</td>
                                    <td>{{ $ad->ads_code }}</td>
                                    <td>{{ $ad->start_date }}</td>
                                    <td>{{ $ad->end_date }}</td>
                                    <td>
                                        <span class="btn btn-{{ $ad->status == 1 ? 'success' : 'danger' }} btn-xs"><i class="fa fa-{{ $ad->status == 1 ? 'check' : 'times'}}"></i></span>
                                    </td>
                                    <td>
                                        <a href="{{ route('ads.edit', $ad->position) }}" class="btn btn-warning btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('ads.destroy', $ad->position) }}" method="post" style="display: inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this ads?')">
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
    @endif
@endsection    