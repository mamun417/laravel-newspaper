@extends('backend.app')

@section('title', 'Bn Tag Insert')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Top Ad</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Top Ad</li>
        </ol>
    </section>

    <!-- Ad List -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Bn Tag</h3>
                    </div>
                    <!-- /.box-header -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($top_ads as $ad)
                            <tr>
                                <td>{{ $ad->id }}</td>
                                <td>{{ $ad->ads_code }}</td>
                                <td>{{ $ad->start_date }}</td>
                                <td>{{ $ad->end_date }}</td>
                                <td>
                                    <span class="btn btn-{{ $ad->status == 1 ? 'success' : 'danger' }} btn-xs"><i class="fa fa-{{ $ad->status == 1 ? 'check' : 'times'}}"></i></span>
                                </td>
                                {{--<td>
                                    <a href="{{ action('BnTagController@edit', $tag->tag_id) }}" class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ action('BnTagController@destroy', $tag->tag_id) }}" method="post" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this tag?')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>

    @if($top_ads->count() < 0)
        <!-- Main content -->
        <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Top Ad Insert</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ action('BnTagController@store') }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
                        {{ csrf_field() }}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="tagName" class="col-sm-2 control-label">Code <span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="code" class="form-control" id="tagName" placeholder="Tag name">
                                    @if($errors->has('code')) <span class="text-danger">{{ $errors->first('code') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="startDate" class="col-sm-2 control-label">Start Date <span class="required">*</span></label></label>
                                <div class="col-sm-8">
                                    <input type="date" name="startDate" id="startDate" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="endDate" class="col-sm-2 control-label">End Date <span class="required">*</span></label></label>
                                <div class="col-sm-8">
                                    <input type="date" name="endDate" id="endDate" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
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
    @endif

@endsection    