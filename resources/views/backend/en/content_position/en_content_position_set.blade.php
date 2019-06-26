@extends('backend.app')

@section('title', 'En Content Position List')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.css') }}">
    <style>
        .ui-widget.ui-widget-content{max-height: 500px; overflow-y: scroll; overflow-x: hidden;}
        .item{list-style: none; background: lightgray; padding: 5px; margin: 2px 0; cursor: move;}
    </style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="display: inline-block;">En Content Position</h1>
      @if(session()->has('successMsg'))
        <div class="alert alert-success alert-dismissable fade in custom-alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> {{ session('successMsg') }}
        </div>
      @endif
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">En Content Position</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-body">
                        {{--<br>
                        <div class="form-inline">
                            {{ csrf_field() }}
                            <input type="hidden" name="position" value="{{ $news_position->position_id }}">
                            <div class="form-group">
                                @php
                                    $aid = explode('/', URL::current());
                                @endphp
                                <label for="newsHeading" class="control-label">Choose postion </label>
                                <select id="positionName" name="positionName" class="form-control">
                                    @foreach($allpositions as $position)
                                        <option value="{{ $position->position_id }}" {{ $position->position_id == $aid[count($aid)-1]? 'selected' : '' }}>{{ $position->position_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="newsHeading" class="control-label">News Heading </label>
                                <input type="text" name="term" id="newsHeading" class="form-control" placeholder="News ID / Title..." required>
                                <input type="hidden" id="positionId" value="{{ $news_position->position_id }}">
                                <input type="hidden" name="newsId" id="newsId">
                            </div>
                            <div class="form-group">
                                <select name="position" id="position" class="form-control">
                                    @for($i=1; $i<=6; $i++);
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="positionSet" class="btn btn-primary">Set</button>
                            </div>
                        </div>
                        <br>--}}
                        <div class="row">
                            <div class="col-sm-1 text-right position-number">
                                <ul id="serial">
                                    @if(!empty($allnews))
                                        @for($i=1; $i <= count($allnews); $i++)
                                            <li>{{ $i }}</li>
                                        @endfor
                                    @endif
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul id="sortable" style="padding: 0">
                                    @if(!empty($allnews))
                                        @foreach($allnews as $news)
                                            <li class="item" id="item-{{ $news->content_id }}">
                                                {{ $news->content_heading }}
                                                <span class="badge">{{ $news->content_id }}</span>
                                                <button id="removePosition" class="btn btn-xs btn-warning pull-right" onclick="removeLi({{ $news->content_id }})">X</button>
                                            </li>
                                        @endforeach
                                    @endif
                                    <input type="hidden" value="{{ $news_position->position_id }}" id="positionId">
                                    <button type="button" onclick="saveData({{ $news_position->position_id }})" class="btn btn-primary">Save</button>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection

@section('custom-js')
    <script>
        $("#positionSet").click(function () {
            var content = $("#newsHeading").val().split(' - ');

            if (content.length != 3){
                alert("Please select the news properly from the dropdown!");
            }else {
                if ($('#serial li').length == 0) {
                    $('#serial').prepend('<li>' + 1 + '</li>');
                    $('#sortable').prepend('<li class="item" id="item-' + content[0] + '" style="background: #ED0000; color: #FFF;">' + content[1] + ' <span class="badge">' + content[0] + '</span><button id="removePosition" class="btn btn-xs btn-warning pull-right" onclick="removeLi(' + content[0] + ')">X</button></li>')
                } else {
                    var serial = $('#serial li').length - 1;
                    var svalue = serial + 2;
                    $('#serial li:eq(' + serial + ')').after('<li>' + svalue + '</li>');
                    var position = $("#position").val() - 1;

                    if ($("#position").val() > $('#sortable li').length) {
                        position = $("#position").val() - 2;
                        $('#sortable li:eq(' + position + ')').after('<li class="item" id="item-' + content[0] + '" style="background: #ED0000; color: #FFF;">' + content[1] + ' <span class="badge">' + content[0] + '</span><button id="removePosition" class="btn btn-xs btn-warning pull-right" onclick="removeLi(' + content[0] + ')">X</button></li>');
                    } else {
                        $('#sortable li:eq(' + position + ')').before('<li class="item" id="item-' + content[0] + '" style="background: #ED0000; color: #FFF;">' + content[1] + ' <span class="badge">' + content[0] + '</span><button id="removePosition" class="btn btn-xs btn-warning pull-right" onclick="removeLi(' + content[0] + ')">X</button></li>');
                    }
                }
            }

        });
        
        $("#sortable").sortable();
        function saveData(posId) {
            var data = $("#sortable").sortable('serialize');
            if(data.length == 0){
                confirm("Please set at least a news!");
            }else{
                var id = posId;
                $.post('{{ url("backend/en-position/change") }}', {'_token': '{{ csrf_token() }}', "data": data, 'id': id}, function(d){
                    alert("The position has been changed!");
                    window.location.href = '{{ url("backend/en-content-position/change") }}/'+d.position_id;
                });
            }

        }

        function removeLi(id) {
            $('#serial li:last-child').remove();
            $('#item-'+id).remove();
        }

        // $("#sortable").sortable();
        // function saveData(posId) {
        //     var data = $("#sortable").sortable('serialize');
        //     var id = posId;
        //     $.post('{{-- url("backend/bn-position/change") --}}', {"data": data, 'id': id}, function(d){
        //         alert("The position has been changed!");
        //         window.location.href = '{{-- url("backend/bn-content-position/change") --}}/'+d.position_id;
        //     });
        // }

        $(function() {
            $("#newsHeading").autocomplete({ // For news title autocomplete
                source: function(request, response) {
                    $.get("{{ url('backend/en-content-position/keyword') }}", { posId: $('#positionId').val(), term: $('#newsHeading').val() }, response);
                },
                minLength: 1,
                select: function (event, ui) {
                    console.log(ui.item);
                    $('#newsId').val(ui.item.id);
                }
            });
        });

        $(function() {
            $('#positionName').change(function() {
                var position = $(this).val();
                $('#newsHeading').val('');
                $('#positionId').val(position);
                //alert(position);
                $.get('{{ url("backend/en-populate-position") }}', {'position': position}, function (data) {
                    //console.log(data.news);
                    $('#serial').empty();
                    var no = 1;
                    $.each(data.news, function() {
                        //$('#sortable').append("<option value='"+ value.id +"'>" + value.name + "</option>");
                        $('#serial').append('<li>'+no+'</li>');
                        no++;
                    });

                    $('#sortable').empty();

                    $.each(data.news, function(key, value) {
                        //$('#sortable').append("<option value='"+ value.id +"'>" + value.name + "</option>");
                        $('#sortable').append('<li class="item ui-sortable-handle" id="item-'+value.content_id+'">'+
                                value.content_heading+
                                '<span class="badge">'+value.content_id +'</span>'+
                                '<button id="removePosition" class="btn btn-xs btn-warning pull-right" onclick="removeLi('+value.content_id+')">X</button>'+
                                '</li>'
                        );
                    });

                    $('#sortable').append('' +
                            '<input type="hidden" value="'+data.position.position_id+'" id="positionId">'+
                            '<button type="button" onclick="saveData('+data.position.position_id+')" class="btn btn-primary">Save</button>'
                    );
                });
            });
        });
    </script>
@endsection