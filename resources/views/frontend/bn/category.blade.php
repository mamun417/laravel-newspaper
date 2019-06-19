@extends('frontend.bn.app')

@section('mainContent')
    <div class="main-content">
        <div class="container">
            <!-- Top Section -->
            <p class="breadcrumb">
                <a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="{{ url($category->cat_slug) }}" class="active">{{ $category->cat_name_bn }}</a>
            </p>
            <div class="row marginBottom20">
                <div class="col-sm-9">
                    <div class="cat-lead-box">
                        @if($contents->count())
                            @php($topCatContent = $contents->shift())
                            @php($sURL = fDesktopURL($topCatContent->content_id, $topCatContent->category->cat_slug, ($topCatContent->subcategory->subcat_slug ?? null), $topCatContent->content_type))
                            <div class="row lead">
                                <div class="col-sm-6">
                                    <div class="imgbox">
                                        <a href="{{ $sURL }}">
                                            @if($topCatContent->video_type == 1 && $topCatContent->video_id)
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $topCatContent->video_id }}/hqdefault.jpg" class="lazyload img-responsive" alt="{{ $topCatContent->content_heading }}">
                                            @else
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $topCatContent->img_bg_path ? asset(config('appconfig.contentImagePath').$topCatContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $topCatContent->content_heading }}" title="{{ $topCatContent->content_heading }}">
                                            @endif

                                            @if($topCatContent->video_id)
                                                <div class="video-icon">
                                                    <i class="fa fa-video-camera"></i>
                                                </div>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h3><a href="{{ $sURL }}" title="{{ $topCatContent->content_heading }}">{{ $topCatContent->content_heading }}</a></h3>
                                    <p class="hidden-xs">{{ fGetWord(fFormatString($topCatContent->content_details), 60) }}</p>
                                </div>
                            </div>

                            <div class="cat-box-with-media default-height">
                                <div class="row">

                                    @if($contents)

                                        @foreach($contents as $content)

                                            @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                            <div class="col-sm-6">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <div class="imgbox">
                                                            <a href="{{ $sURL }}">
                                                                @if($content->video_type == 1 && $content->video_id)
                                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                                                @else
                                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                                @endif

                                                                @if($content->video_id)
                                                                    <div class="video-icon">
                                                                        <i class="fa fa-video-camera"></i>
                                                                    </div>
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                                        </h4>
                                                        <p>
                                                            <small class="text-muted">
                                                                <i class="fa fa-calendar"></i>
                                                                {{ fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($content->created_at))) }}
                                                            </small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endif
                        <hr>

                        {{ $contents->links('vendor.pagination.bn-default') }}

                    </div>
                </div>
                <div class="col-sm-3">
                    <!-- Tab links -->
                    <div class="marginBottom20" style="box-shadow: 0 2px 1px 1px #d5d5d5;">
                        @include('frontend.bn.layouts.latestPopularBox')
                    </div>

                    <div>
                        @if($otherCatContents->count())
                            <div class="common-title common-title-brown mb-4">
                                <span class="common-title-shape">
                                    <a class="common-title-link" href="{{ url($otherCatContents->first()->category->cat_slug) }}">{{ $otherCatContents->first()->category->cat_name_bn }}</a>
                                </span>
                            </div>
                            <div class="cat-box-with-media default-height">
                                @foreach($otherCatContents as $content)

                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                    <div class="media">
                                        <div class="media-left">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    @if($content->video_type == 1 && $content->video_id)
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                                    @else
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                    @endif

                                                    @if($content->video_id)
                                                        <div class="video-icon">
                                                            <i class="fa fa-video-camera"></i>
                                                        </div>
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection