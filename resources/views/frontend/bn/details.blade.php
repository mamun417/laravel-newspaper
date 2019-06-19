@extends('frontend.bn.app')

@section('title', $detailsContent->content_heading)

@section('customMeta')
    <meta property="og:type" content="article"/>
    @php($sURL = fDesktopURL($detailsContent->content_id,$detailsContent->category->cat_slug,($detailsContent->subcategory ? $detailsContent->subcategory->subcat_slug : null),$detailsContent->content_type))
    <meta property="og:url" content="{{ $sURL }}" />
    <meta property="og:title" content="{{ $detailsContent->content_heading }}"/>
    <meta property="og:image" content="{{ asset(config('appconfig.contentImagePath').$detailsContent->img_bg_path) }}"/>
    <meta property="og:site_name" content="{{ config('app.url') }}"/>
    <meta property="og:description" content="{{ !empty($detailsContent->meta_details) ? $detailsContent->meta_details : fGetWord(fFormatString($detailsContent->content_brief),20) }}"/>
    <meta property="article:author" content="{{ config('app.name') }}" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@bangladeshTimes">
    <meta name="twitter:title" content="{{ $detailsContent->content_heading }}">
    <meta name="twitter:description" content="{{ !empty($detailsContent->meta_details) ? $detailsContent->meta_details : fGetWord(fFormatString($detailsContent->content_brief),20) }}">
    <meta name="twitter:image" content="{{ asset(config('appconfig.contentImagePath').$detailsContent->img_bg_path) }}">
    <meta name="description" content="{{ !empty($detailsContent->meta_details) ? $detailsContent->meta_details : fGetWord(fFormatString($detailsContent->content_brief),20) }}" />
@endsection

@section('mainContent')

    <div class="main-content">
        <div class="container">
            <!-- Top Section -->
            <p class="breadcrumb">
                <a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="{{ url($detailsContent->category->cat_slug) }}" class="active">{{ $detailsContent->category->cat_name_bn }}</a>
            </p>

            <div class="row marginBottom20">
                <div class="col-sm-9">
                    <div class="news-details">
                        <h1>{{ $detailsContent->content_heading }}</h1>
                        <p class="news-time">
                            <i class="fa fa-clock-o"></i> {{ fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($detailsContent->created_at))) }}
                            {{ $detailsContent->updated_at ? '| আপডেট: ' . fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($detailsContent->updated_at))) : '' }}
                        </p>
                        <hr>

                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox"></div>

                        <div class="imgbox">

                            @if($detailsContent->video_id)
                                @if($detailsContent->video_type == 1)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <figure class="content-media content-media--video" id="featured-media">
                                    <iframe src="https://www.youtube.com/embed/{{ $detailsContent->video_id }}?enablejsapi=1&rel=1&showinfo=1&controls=1" frameborder="0" allowfullscreen></iframe>
                                            </figure>
                                        </div>
                                @elseif($detailsContent->video_type == 2)
                                    <div class="fb-video" data-href="https://www.facebook.com/{{ $detailsContent->video_id }}" data-autoplay="false" data-show-text="false" data-show-captions="false" data-allowfullscreen="true"></div>
                                @endif

                            @else
                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $detailsContent->img_bg_path ? asset(config('appconfig.contentImagePath').$detailsContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $detailsContent->content_heading }}" title="{{ $detailsContent->content_heading }}">

                            @endif
                        </div>

                        @if($detailsContent->img_bg_caption)
                            <div class="caption">
                                {{ $detailsContent->img_bg_caption }}
                            </div>
                        @endif

                        <div class="description">{!! $detailsContent->content_details !!}</div>
                    </div>
                    <hr>
                    <div class="gist">
                        <p>বিভাগ : <a href="{{ url($detailsContent->category->cat_slug) }}"> {{ $detailsContent->category->cat_name_bn }}</a></p>

                        @if($detailsContent->tags)
                            @php($tags = explode(',', $detailsContent->tags))
                            <p>বিষয় :
                            @foreach($tags as $tag)
                                    <a href="{{ url('/topic'.$tag) }}" class="bg-info">{{ $tag }}</a>
                                @if(!$loop->last), @endif
                            @endforeach
                            </p>
                        @endif

                    </div>
                    <hr>
                </div>
                <div class="col-sm-3">
                    <!-- Tab links -->
                    <div class="marginBottom20" style="box-shadow: 0 2px 1px 1px #d5d5d5;">
                        @include('frontend.bn.layouts.latestPopularBox')
                    </div>
                    <div>
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <span class="common-title-link">এই বিভাগের আরও </span>
                            </span>
                        </div>
                        <div class="cat-box-with-media default-height">

                            @foreach($moreContents as $content)

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
                    </div>
                </div>
            </div>

            @if($relatedContents)
                <div class="row related-news">
                    <div class="col-sm-12">
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <a class="common-title-link" href="#">আরও পড়ুন</a>
                            </span>
                        </div>
                        <div class="row FlexRow">

                            @foreach($relatedContents as $content)

                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                <div class="col-sm-3 col-xs-6">
                                    <div class="single_related">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                @if($content->video_type == 1 && $content->video_id)
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
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
                                        <h3><a href="{{ $sURL }}" title="{{ $content->content_heading }}">{{ $content->content_heading }}</a></h3>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>

            @endif

            @if($popularContents)
                <div class="row related-news">
                    <div class="col-sm-12">
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <a class="common-title-link" href="#">আলোচিত সংবাদ</a>
                            </span>
                        </div>
                        <div class="row FlexRow">
                            @php($alochitoContents = $popularContents->splice(0,6))
                            @foreach($alochitoContents as $content)

                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                <div class="col-sm-2 col-xs-6">
                                    <div class="single_related">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                @if($content->video_type == 1 && $content->video_id)
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
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
                                        <h3><a href="{{ $sURL }}" title="{{ $content->content_heading }}">{{ $content->content_heading }}</a></h3>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>

@endsection
