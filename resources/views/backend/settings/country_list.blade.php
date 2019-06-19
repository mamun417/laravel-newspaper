@extends('backend.app')

@section('title', 'Country List')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="display: inline-block;">Country</h1>
      @if(session()->has('successMsg'))
        <div class="alert alert-success alert-dismissable fade in custom-alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> {{ session('successMsg') }}
        </div>
      @endif
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Country</li>
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
              <h3 class="box-title">List of Country</h3>
              <a href="{{ url('backend/countries/create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.box-header -->
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>Country Name</th>
                  <th>Country Name (Bn)</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($countries as $no => $country)
                  <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $country->country_name }}</td>
                    <td>{{ $country->country_name_bn }}</td>
                    <td>
                      <a href="{{ action('CountryController@edit', $country->country_id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <form action="{{ action('CountryController@destroy', $country->country_id) }}" method="post" style="display: inline">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this country?')">
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