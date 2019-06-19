@extends('backend.app')

@section('title', 'Create English News')

@section('custom-css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/adminlte/plugins/cropbox/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/adminlte/plugins/tag-it-master/css/jquery.tagit.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/adminlte/plugins/tag-it-master/css/tagit.ui-zendesk.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/token-input.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>English News Insert</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">News</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- form start -->
        <form action="{{ action('EnContentController@store') }}" method="post" enctype="multipart/form-data">
	        <div class="col-md-8" style="padding-right: 0">
	          <!-- Horizontal Form -->
	          <div class="box box-info">	
	              {{ csrf_field() }}
	              <div class="box-body">
	                <div class="form-group">
	                  	<label for="newsHeading">News Heading <span class="required">*</span></label>
	                    <input type="text" name="newsHeading" class="form-control" id="newsHeading" placeholder="News Heading" value="{{ old('newsHeading') }}">
	                    @if($errors->has('newsHeading')) <span class="text-danger">{{ $errors->first('newsHeading') }}</span> @endif
	                </div>

	                <div class="form-group">
	                  	<label for="newsHeading">News Subheading</label>
	                    <input type="text" name="newsSubheading" class="form-control" id="newsSubheading" placeholder="News Subheading" value="{{ old('newsSubheading') }}">
	                </div>

	                <div class="form-group">
		                <label for="writer">Writer</label>
		                <select name="writer" id="writer" class="form-control">
		                	@foreach($authors as $author)
		                		<option value="{{ $author->author_name_slug }}"{{ $author->author_slug == old('writer') ? ' selected' : '' }}>{{ $author->author_name }}</option>
		                	@endforeach
		                </select>
	                </div>

	                <div class="form-group">
	                	<label for="briefNews">Brief News</label>
	                	<textarea name="briefNews" id="briefNews" class="form-control" rows="4" placeholder="Brief News">{{ old('briefNews') }}</textarea>
	                </div>

	                <div class="form-group">
	                	<label for="detailsNews">Details News</label>
	                	<textarea name="detailsNews" id="detailsNews" class="form-control textarea" rows="10" placeholder="Details News">{{ old('detailsNews') }}</textarea>
	                	<input name="image" type="file" id="upload" class="hidden" onchange="">
	                </div>

	                <div class="form-group">
	                	<div class="row">
							<div class="col-sm-12">
								<div class="box box-success text-center">
									<h3>Large Image</h3>
									<div class="text-danger" style="margin-bottom: 5px;">Dimension: 750 X 390 pixel & Max size: 100kb</div>

									@if($errors->has('largeImage')) <span class="text-danger">{{ $errors->first('largeImage') }}</span> @endif
									<div class="row">
										<div class="col-sm-4">
											<!-- <input type="file" name="ImageBGLocalPath" class="ImageBGLocalPath" id="ImageBGLocalPath"> -->
											<input type="file" name="largeImage" class="largeImage" id="largeImage">
										</div>
										<div class="col-sm-8">
											<label for="largeImage" class="btn bg-purple btn-flat pull-left">Local</label>
											{{--<input type="text" name="ImageBGPath" class="form-control" id="ImageBGPath" readonly>--}}
										</div>
									</div>
									<div class="row">
										{{--<div class="col-sm-4">--}}
										{{--<input type="hidden" name="ImageBGLocalName" id="ImageBGLocalName">--}}
										{{--<label for="largeImage" class="btn bg-purple btn-flat">Local</label>--}}
										{{--<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#BGImageArchive">Achieve</button>--}}
										{{--<button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#cropBG">Crop</button>--}}
										{{--<button type="button" class="btn btn-warning btn-flat" onclick="document.getElementById('ImageBGPath').value=''">Clear</button>--}}
										{{--</div>--}}
										<div class="col-sm-12">
											<input type="text" name="ImageBGCaption" class="form-control" id="ImageBGCaption" placeholder="Image caption" value="{{ old('ImageBGCaption') }}" style="margin-top: 5px;">
										</div>
									</div>
								</div>
							</div>
	                	</div>
	                </div>
	              </div>
	              <!-- /.box-body -->
	          </div>
	        </div>
	        <div class="col-md-4">
	        	<div class="box box-info">
	        		<div class="box-body form-horizontal">
	        			<div class="form-group">
							<label for="contentType" class="col-sm-3">Content Type </label>
							<div class="col-sm-9">
								<select name="contentType" class="form-control" id="contentType">
									<option value="1"{{ old('contentType') == 1 ? ' selected' : '' }}>News</option>
									<option value="2"{{ old('contentType') == 2 ? ' selected' : '' }}>Article</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="category" class="col-sm-3">Category</label>
							<div class="col-sm-9">
								<select name="category" class="form-control" id="category">
									@foreach($categories as $category)
										<option value="{{ $category->cat_id }}"{{ old('category') == $category->cat_id ? ' selected' : '' }}>{{ $category->cat_name }}</option>
									@endforeach
								</select>
							</div>
							@if($errors->has('category')) <span class="text-danger">{{ $errors->first('category') }}</span> @endif
						</div>

						<div class="form-group">
							<label for="subCategory" class="col-sm-3">SubCategory</label>
							<div class="col-sm-9">
								<select id="subCategory" name="subCategory" class="form-control "></select>
							</div>
						</div>

						<div class="form-group">
							<label for="specialCategory" class="col-sm-3">Special Category</label>
							<div class="col-sm-9">
								<select name="specialCategory" id="specialCategory" class="form-control">
									<option value="1">--None--</option>
									@foreach($specialCategories as $specialCategory)
										<option value="{{ $specialCategory->cat_id}}"{{ old('specialCategory') == $specialCategory->cat_id ? ' selected' : '' }}>{{ $specialCategory->cat_name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="country" class="col-sm-3">Country</label>
							<div class="col-sm-9">
								<select name="country" id="country" class="form-control">
									@foreach($countries as $country)
										<option value="{{ $country->country_id }}" {{ $country->country_name == 'Bangladesh' ? 'selected' : '' }}>{{ $country->country_name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="district" class="col-sm-3">District</label>
							<div class="col-sm-9">
								<select name="district" id="district" class="form-control">
									@foreach($districts as $district)
										<option value="{{ $district->district_id }}"{{ old('district') == $district->district_id ? ' selected' : '' }}>{{ $district->district_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="uploader" class="col-sm-3">Uploader</label>
							<div class="col-sm-9">
								<select name="uploader" id="uploader" class="form-control">
									@foreach($mis_uploaders as $mis_uploader)
										<option value="{{ $mis_uploader->user_id }}" {{ auth()->user()->id == $mis_uploader->admin_id ? 'selected' : '' }}>{{ $mis_uploader->user_name }}</option>
									@endforeach
								</select>
								@if($errors->has('uploader')) <span class="text-danger">{{ $errors->first('uploader') }}</span> @endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3">Related ID</label>
							<div class="col-sm-9">
								<ul class="myTags" id="prevNewsIds"></ul>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3">P.GalleryID</label>
							<div class="col-sm-9">
								<ul class="myTags" id="photoGalaryIds"></ul>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3" for="videoType">Video Type</label>
							<div class="col-sm-9">
								<select name="videoType" id="videoType" class="form-control">
									<option value="">Choose type</option>
									<option value="1"{{ old('videoType') == 1 ? ' selected' : '' }}>Youtube</option>
									<option value="2"{{ old('videoType') == 2 ? ' selected' : '' }}>Facebook</option>
								</select>
							</div>
						</div>
					
						<div class="form-group">
							<label class="col-sm-3" for="videoId">Video ID</label>
							<div class="col-sm-9">
								<input type="text" id="videoId" name="videoId" class="form-control" value="{{ old('videoId') }}">
							</div>
						</div>
					
						<div class="form-group row">
							<label class="col-sm-3">Normal Tag</label>
							<div class="col-sm-9">
								<input class="form-control" id="normal-tags" name="normalTags" autocomplete="off">
							</div>
						</div>
						<div class="row" style="margin-left: 0; margin-right: 0;">
							<div class="col-sm-9" style="width: 100%">
								<div class="form-group">
									<div class="well well-sm no-margin">
										<div class="btn-group radioBtn">
											<a class="btn btn-primary btn-sm notActive" data-toggle="scroll" data-title="2">Y</a>
											<a class="btn btn-primary btn-sm active" data-toggle="scroll" data-title="1">N</a>
										</div>
										<label for="scroll" class="">Scroll?</label>
										<input type="hidden" name="scroll" id="scroll" value="1">
									</div>
								</div>
							</div>
						</div>						
				
		        		<div class="form-group">
		        			<div class="col-sm-8">
			                	<button type="submit" class="btn btn-info btn-block">Submit</button>
			                </div>
			                <div class="col-sm-4" style="padding-left: 0;">
			                	<a href="{{ URL::previous() }}" class="btn btn-default btn-block">Back</a>
		        			</div>
		                </div>

	        		</div>
	        	</div>
	        </div>
        </form>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->

	<!-- Modal EXSM Archive -->
	<div class="modal fade" id="ExSMImageArchive" tabindex="-1" role="dialog" aria-labelledby="ExSMImageArchive">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="ExSMImageArchive">Extra SM Image Archive</h4>
				</div>
				<div class="modal-body">
					<div class="filemanager">
						<div class="search">
							<input type="search" class="form-control" placeholder="Find a file.." />
						</div>
					</div>
					<div class="result"></div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal SM Archive -->
	<div class="modal fade" id="SMImageArchive" tabindex="-1" role="dialog" aria-labelledby="SMImageArchive">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="SMImageArchive">SM Image Archive</h4>
				</div>
				<div class="modal-body">
					<div class="filemanager">
						<div class="search">
							<input type="search" class="form-control" placeholder="Find a file.." />
						</div>
					</div>
					<div class="result"></div>
				</div>
			</div>
		</div>
	</div>

<!-- BG Archive Modal-->
	<div class="modal fade" id="BGImageArchive" tabindex="-1" role="dialog" aria-labelledby="BGImageArchive">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="BGImageArchive">BG Image Archive</h4>
				</div>
				<div class="modal-body">
					<div class="filemanager">
						<div class="search">
							<input type="search" class="form-control" placeholder="Find a file.." />
						</div>
					</div>
					<div class="result"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- End archive modal -->


	<!-- Start upload modal SM crop-->
	<div class="modal fade" id="cropSM" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Crop image</h4>
				</div>
				<div class="modal-body">
					<div class="imageBox">
						<div class="thumbBox"></div>
					</div>
					<div class="action">
						<input type="file" id="file" style="float:left; width:250px">
						<input type="button" id="btnCrop" value="Crop" style="float:right">
						<input type="button" id="btnZoomIn" value="+" style="float:right">
						<input type="button" id="btnZoomOut" value="-" style="float:right">
					</div>
					<div class="cropped"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- End upload modal -->
@endsection

@section('custom-js')
	<script type="text/javascript" src="{{ asset('backend/adminlte/plugins/cropbox/jquery/cropbox-min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/adminlte/plugins/tag-it-master/js/tag-it.min.js') }}"></script>

	<script type="text/javascript">
	    $(function () {
	        // radio yes-no
	        $('.radioBtn a').on('click', function () {
	            var sel = $(this).data('title');
	            var tog = $(this).data('toggle');
	            $('#' + tog).prop('value', sel);

	            $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
	            $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
	        });
	    });

		$(window).load(function() {
			var options ={thumbBox: '.thumbBox',imgSrc: ''};
			var cropper = $('.imageBox').cropbox(options);
			$('#file').on('change', function(){
				$('.cropped').empty();
				var reader = new FileReader();
				reader.onload = function(e) {options.imgSrc = e.target.result;cropper = $('.imageBox').cropbox(options);};
				reader.readAsDataURL(this.files[0]);
				this.files = [];
			});
			$('#btnCrop').on('click', function(){
				var img = cropper.getDataURL();
				$('.cropped').empty();
				$('.cropped').append('<img src="'+img+'">');
				$(".cropped img").dblclick(function() {
					var ImgSrc=$(this).attr("src");
					var ImageSMPath = document.getElementById("ImageSMPath");
					ImageSMPath.value=ImgSrc;
					var filename = document.getElementById('file').files[0].name;
					document.getElementById("ImageSMLocalName").value=filename;
					//console.log(ImageSMName)
					$('#cropSM').modal('hide');
				});
			});
			$('#btnZoomIn').on('click', function(){cropper.zoomIn();});
			$('#btnZoomOut').on('click', function(){cropper.zoomOut();});
		});

		var catId = $("#category").val();
		
        $.get('{{ url("backend/en-subcat-populate?cat_id=") }}'+catId, function(data){
            $('#subCategory').prepend('<option value="1" selected>--None--</option>');
            $.each(data, function(index, subcatObj){
				$('#subCategory').append('<option value="'+subcatObj.subcat_id+'">'+subcatObj.subcat_name+'</option>');
			});
        });

		// Sub category populated when select a category
		$('#category').change(function(){ // Pre-populate subcategory dropdown
			var cat_id = $(this).val();
			$('#subCategory').empty();
			$.get('{{ url("backend/en-subcat-populate?cat_id=") }}'+cat_id, function(data){
				$.each(data, function(index, subcatObj){
					$('#subCategory').append('<option value="'+subcatObj.subcat_id+'">'+subcatObj.subcat_name+'</option>');
				});
				$('#subCategory').prepend('<option value="1" selected>--None--</option>');
			});
		});

		// Previous news id's tag-it
		$('#prevNewsIds').tagit({
			fieldName: "prevNewsIds[]"
		});

		// Previous Photo galary id tag-it
		$('#photoGalaryIds').tagit({
			fieldName: "photoGalaryIds[]"
		});
		// Previous meta keyword tag-it
		$('#metaKeyword').tagit({
			fieldName: "metaKeyword[]"
		});

	</script>
	<script src="{{ asset('backend/js/jquery.tokeninput.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#normal-tags").tokenInput("{{ url('backend/en-normaltag-search')}}",{preventDuplicates: true});
		});
	</script>
	<script src="{{ asset('backend/adminlte/cute-file-browser/js/script.js') }}"></script>
    <script src="{{ asset('backend/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '.textarea',
            plugins:'advlist autolink lists textcolor colorpicker link code wordcount media image imagetools searchreplace charmap anchor visualblocks fullscreen table contextmenu paste',
            menubar: true,
            height : "300",
            toolbar1: 'insertfile | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor link code media image',
            rel_list: [
                {title: 'nofollow', value: 'nofollow'},
                {title: 'follow', value: 'follow'}
            ],
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype == 'image') {
                    $('#upload').trigger('click');
                    $('#upload').on('change', function() {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var imagevalue = e.target.result;
                            var filename = $("#upload").val().substring($("#upload").val().lastIndexOf('\\') + 1);
                            $.post('{{ url("backend/attach-photo-upload") }}', {"_token": "{{ csrf_token() }}", 'filename': filename, 'imagevalue': imagevalue}, function (data) {
                                var data = 'https://www.dhakaprokash24.com/np-uploads/content/images/'+data;
                                //console.log(data);
                                callback(data, {
                                    alt: ''
                                });
                            });
                        };
                        reader.readAsDataURL(file);
                    });
                }
            },
            toolbar: "...| removeformat | ...",
            media_live_embeds: true,
            relative_urls : false,
            remove_script_host : false,
            extended_valid_elements: 'script[type|src|charset]'
        });
    </script>

@endsection