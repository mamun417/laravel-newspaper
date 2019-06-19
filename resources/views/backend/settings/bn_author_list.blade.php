@extends('backend.app')

@section('title', 'Author List')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="display: inline-block;">Author</h1>
      @if(session()->has('successMsg'))
        <div class="alert alert-success alert-dismissable fade in custom-alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> {{ session('successMsg') }}
        </div>
      @endif
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Author</li>
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
              <h3 class="box-title">List of Author</h3>
              <a href="{{ url('backend/bn-authors/create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.box-header -->
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>Author Name</th>
                  <th>Author Name Bn</th>
                  <th>Author Initial</th>
                  <th>Author Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($authors as $no => $author)
                  <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $author->author_name }}</td>
                    <td>{{ config('customdata.author_types')[$author->author_type] }}</td>
                    <td>{{ $author->author_initial }}</td>
                    <td>
                      <img src="{{ asset(config('appconfig.authorImagePath').$author->img_path) }}" alt="{{ $author->author_name }}" class="img-thumbnail" style="width: 100px; height: 100px;">
                    </td>
                    <td>
                      <a href="{{ action('BnAuthorController@edit', $author->author_id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <form action="{{ action('BnAuthorController@destroy', $author->author_id) }}" method="post" style="display: inline">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this author?')">
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
    <!-- /.content -->
@endsection    