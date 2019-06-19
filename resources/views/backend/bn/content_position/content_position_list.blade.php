@extends('backend.app')

@section('title', 'Bn Content Position List')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="display: inline-block;">Bn Content Position</h1>
      @if(session()->has('successMsg'))
        <div class="alert alert-success alert-dismissable fade in custom-alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> {{ session('successMsg') }}
        </div>
      @endif
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bn Content Position</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">List of Category</h3>
                      <a href="{{ url('backend/bn-content-position/create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
                    </div>                
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-striped">
                            <tbody>
                            <tr>
                                <th>Position Name</th>
                                <th>Category ID</th>
                                <th>News IDs </th>
                                <th style="width:100px;">Action</th>
                            </tr>
                            @foreach($content_positions as $content_position)
                                <tr>
                                    <td>
                                        {{ $content_position->position_name }}
                                        @if($content_position->special_cat_id)
                                            <small class="label label-info">Special</small>
                                        @endif
                                    </td>
                                    <td>{{ $content_position->special_cat_id ? $content_position->special_cat_id : $content_position->cat_id }}</td>
                                    <td>{{ $content_position->content_ids }}</td>
                                    <td>
                                        <a href="{{ action('BnContentPositionController@getChangePosition', $content_position->position_id) }}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Change Position</a>
                                        @if(auth()->user()->role == 1)
                                            <a href="{{ action('BnContentPositionController@edit', $content_position->position_id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit </a>
                                            <form action="{{ action('BnContentPositionController@destroy', $content_position->position_id) }}" method="post" style="display: inline;">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete the content position?')"><i class="fa fa-remove"></i> Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection    