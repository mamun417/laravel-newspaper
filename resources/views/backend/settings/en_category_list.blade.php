@extends('backend.app')

@section('title', 'En Category List')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="display: inline-block;">En Category</h1>
        @if(session()->has('successMsg'))
            <div class="alert alert-success alert-dismissable fade in custom-alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session('successMsg') }}
            </div>
        @endif
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
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
                        <h3 class="box-title">List of En Category</h3>
                        <a href="{{ url('backend/en-categories/create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
                    </div>
                    <!-- /.box-header -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Show Menu</th>
                            <th>Category Position</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $no => $category)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>
                                    @if($category->cat_type == 2)
                                        <span class="label label-info">{{ $category->cat_name }}</span>
                                    @else
                                        {{ $category->cat_name }}
                                    @endif
                                </td>
                                <td>
                                    Top Menu: <span class="label label-{{ $category->top_menu == 1 ? 'success' : 'danger' }}">{{ $category->top_menu == 1 ? 'Yes' : 'No' }}</span><br>
                                    Footer Menu: <span class="label label-{{ $category->footer_menu == 1 ? 'success' : 'danger' }}">{{ $category->footer_menu == 1 ? 'Yes' : 'No' }}</span>
                                </td>
                                <td>{{ $category->cat_position }}</td>
                                <td>
                                    <span class="btn btn-{{ $category->status == 1 ? 'success' : 'danger' }} btn-xs"><i class="fa fa-{{ $category->status == 1 ? 'check' : 'times'}}"></i></span>
                                </td>
                                <td>
                                    <a href="{{ action('EnCategoryController@edit', $category->cat_id) }}" class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ action('EnCategoryController@destroy', $category->cat_id) }}" method="post" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this category?')">
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