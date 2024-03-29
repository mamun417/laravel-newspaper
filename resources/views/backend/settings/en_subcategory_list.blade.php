@extends('backend.app')

@section('title', 'En Subcategory List')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="display: inline-block;">En Subcategory</h1>
        @if(session()->has('successMsg'))
            <div class="alert alert-success alert-dismissable fade in custom-alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session('successMsg') }}
            </div>
        @endif
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">En Subcategory</li>
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
                        <h3 class="box-title">List of En Subcategory</h3>
                        <a href="{{ url('backend/en-subcategories/create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
                    </div>
                    <!-- /.box-header -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Subcategory Name</th>
                            <th>Category</th>
                            <th>Subcategory Position</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subcategories as $no => $subcategory)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $subcategory->subcat_name }}</td>
                                <td>{{ $subcategory->category->cat_name }}</td>
                                <td>{{ $subcategory->subcat_position }}</td>
                                <td>
                                    <span class="btn btn-{{ $subcategory->status == 1 ? 'success' : 'danger' }} btn-xs"><i class="fa fa-{{ $subcategory->status == 1 ? 'check' : 'times'}}"></i></span>
                                </td>
                                <td>
                                    <a href="{{ action('EnSubcategoryController@edit', $subcategory->subcat_id) }}" class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ action('EnSubcategoryController@destroy', $subcategory->subcat_id) }}" method="post" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this subcategory?')">
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