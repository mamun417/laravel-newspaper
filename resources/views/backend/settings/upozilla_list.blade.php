@extends('backend.app')
@section('title','Upozilla List')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="display: inline-block;">Upozilla</h1>
        @if(session()->has('successMsg'))
            <div class="alert alert-success alert-dismissable fade in custom-alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session('successMsg') }}
            </div>
        @endif
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Upozilla</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Upozilla</h3>
                        <a href="{{ url('backend/upozillas/create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Upozilla Name</th>
                                    <th>Upozilla Name (Bangla)</th>
                                    <th>District Name</th>
                                    <th style="width:160px;">Action</th>
                                </tr>
                                @php $no = $upozillas->firstItem() @endphp
                                @foreach($upozillas as $upozilla)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $upozilla->upozilla_name }}</td>
                                        <td>{{ $upozilla->upozilla_name_bn }}</td>
                                        <td>{{ $upozilla->district->district_name }}</td>
                                        <td>
                                            <a href="{{ action('UpozillaController@edit', $upozilla->upozilla_id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                            <form action="{{ action('UpozillaController@destroy', $upozilla->upozilla_id) }}" method="post" style="display: inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" onclick="return confirm('Are you sure to delete this upozilla?')" class="btn btn-danger btn-xs">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                    @php $no++ @endphp
                                @endforeach
                            <tr>
                                <td colspan="5">{{ $upozillas->links() }}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection