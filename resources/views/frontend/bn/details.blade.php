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
            <!-- Top Section -->
            <div class="pl-3 py-3 border-light border-bottom mb-3 bg-light">
                <div class="container">
                    <ol class="list-unstyled list-inline m-0">
                        <li class="d-inline-block"><a href="{{ url('/') }}" class="text-success"><i class="fa fa-home"></i></a></li> »
                        <li class="d-inline-block"><a href="{{ url($detailsContent->category->cat_slug) }}" class="text-success">{{ $detailsContent->category->cat_name_bn }}</a></li>
                    </ol>
                </div>
            </div>


        <div class="container py-2 mb-4">
            <div class="row">
                <div class="col-sm-8">
                    <div>
                        <h2 class="font-weight-bold text-dark m-font-24">
                            {{ $detailsContent->content_heading }}
                        </h2>
                        <p class="small text-muted">
                            <i class="fa fa-clock-o"></i> {{ fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($detailsContent->created_at))) }}
                            {{ $detailsContent->updated_at ? '| আপডেট: ' . fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($detailsContent->updated_at))) : '' }}
                        </p>
                    </div>
                    <figure class="figure">
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
                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $detailsContent->img_bg_path ? asset(config('appconfig.contentImagePath').$detailsContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"  class="lazyload img-responsive w-100" alt="{{ $detailsContent->content_heading }}" title="{{ $detailsContent->content_heading }}">

                            @endif
                        </div>
                    </figure>

                    <div class="details">
                        {!! $detailsContent->content_details !!}
                    </div>
                    @if($detailsContent->tags)
                    <div class="border-top border-bottom py-3 my-2">

                            @php($tags = explode(',', $detailsContent->tags))
                            <i class="fa fa-tags text-success"></i>
                                @foreach($tags as $tag)
                                    <a href="{{ url('/topic'.$tag) }}" class="btn btn-sm btn-outline-success rounded-pill">{{ $tag }}</a>
                                    @if(!$loop->last) @endif
                                @endforeach
                    </div>
                    @endif
                </div>

                <div class="col-sm-4">

                    <!--News Details Right Top Add-->
                    <div class="my-4 text-center">
                        <img class="" src="https://www.jonotarkotha.com/np-uploads/advertisement/walton.png">
                    </div>

                    @if($relatedContents)
                    <div class="shadow-sm rounded mb-4 border-top">
                        <h6 class="font-weight-bold text-center bg-light m-0 p-3">এই বিভাগের আরো খবর </h6>
                        <div class="list-group list-group-flush">

                            @foreach($relatedContents as $content)

                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                <a href="{{ $sURL }}" class="list-group-item list-group-item-action link">{{ $content->content_heading }}</a>

                            @endforeach

                        </div>
                        <div class="text-center p-3">
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary">সবখবর</a>
                        </div>
                    </div>
                    @endif

                    <div class="shadow-sm mb-4 rounded-0 border-top">
                        @include('frontend.bn.layouts.latestPopularBox')
                    </div>

                    <!--News Details Right Bottom Add-->
                    <div class="my-4 text-center">
                        <img class="" src="https://www.jonotarkotha.com/np-uploads/advertisement/walton.png">
                    </div>

                </div>
            </div>

            <div class="pt-4">
                <h2 class="rakSab-common-cat-title"><span>আরও পড়ুন</span></h2>
                @if($popularContents)
                <div class="row">
                    @php($alochitoContents = $popularContents->splice(0,4))
                    @foreach($alochitoContents as $content)

                        @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                        <div class="col-sm-3 d-flex mb-3 col-6">
                        <a href="{{ $sURL }}" title="{{ $content->content_heading }}" class="d-block border-bottom border-success text-dark shadow-sm w-100 link">
                            <figure class="figure mb-0">
                                <img src="https://s3-ap-southeast-1.amazonaws.com/images.jagonews24/media/imgAllNew/SM/2019January/drink-poison-die-women-20190209142948.jpg" alt="Text" class="w-100 mb-2">
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
                            </figure>
                            <div class="px-3 py-2">
                                <h6 class="font-weight-bold">{{ $content->content_heading }}</h6>
                            </div>
                        </a>
                    </div>
                    @endforeach

                </div>
                @endif
            </div>
        </div>

    </div>

@endsection
