@extends('frontend.bn.app')

@section('title', cache('bnSiteSettings')->title)

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/marquee/marquee.css') }}">
@endsection

@section('mainContent')

    <div class="main-content">
        <div class="container">
            {{-- Marquee/scroll news --}}
            @include('frontend.bn.common.breaking-marquee')
            <!-- Top Section -->
            <div class="row marginBottom50">
                <div class="col-sm-9">
                    <div class="special-box">

                        @if($specialTopContents)
                            <div class="row">
                                @php($spTopContent = $specialTopContents->shift())

                                <div class="col-sm-8 lead">

                                    @if($spTopContent)

                                        @php($sURL = fDesktopURL($spTopContent->content_id, $spTopContent->category->cat_slug, ($spTopContent->subcategory->subcat_slug ?? null), $spTopContent->content_type))
                                        <a href="{{ $sURL }}" title="{{ $spTopContent->content_heading }}">

                                            @if($spTopContent->video_type == 1 && $spTopContent->video_id)
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $spTopContent->video_id }}/hqdefault.jpg" class="lazyload img-responsive" alt="{{ $spTopContent->content_heading }}">
                                            @else
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $spTopContent->img_bg_path ? asset(config('appconfig.contentImagePath').$spTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="lazyload img-responsive" alt="{{ $spTopContent->content_heading }}" title="{{ $spTopContent->content_heading }}">
                                            @endif

                                        </a>
                                        <h3>

                                            <a href="{{ $sURL }}" title="{{ $spTopContent->content_heading }}">
                                                @if($spTopContent->content_sub_heading)
                                                    <b class="sub-heading">{{ $spTopContent->content_sub_heading }}</b>
                                                @endif
                                                {{ $spTopContent->content_heading }}
                                            </a>
                                        </h3>
                                        <p>{{ fGetWord(fFormatString($spTopContent->content_details), 40) }}</p>
                                    @endif

                                </div>

                                @php($spTopRightTwoContents = $specialTopContents->splice(0,2))
                                <div class="col-sm-4">
                                    <div class="row special-sub FlexRow">
                                        @if($spTopRightTwoContents)
                                            @foreach($spTopRightTwoContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <div class="col-sm-12 col-xs-6">
                                                    <div class="single_sub">
                                                        <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                            @if($content->video_type == 1 && $content->video_id)
                                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                                            @else
                                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                            @endif
                                                        </a>
                                                        <h3>
                                                            <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                                @if($content->content_sub_heading)
                                                                    <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                                                @endif
                                                                {{ $content->content_heading }}
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row special-sub FlexRow">
                                @php($spOtherContents = $specialTopContents->all())

                                @if($spOtherContents)

                                    @foreach($spOtherContents as $content)

                                        @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                        <div class="col-sm-4 col-xs-6">
                                            <div class="single_sub">
                                                <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                    @if($content->video_type == 1 && $content->video_id)
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                                    @else
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                    @endif
                                                </a>
                                                <h3>
                                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                        @if($content->content_sub_heading)
                                                            <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                                        @endif
                                                        {{ $content->content_heading }}
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>

                                    @endforeach

                                @endif

                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <ul class="top-social list-inline">
                        <li><a href="" rel="nofollow" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="" rel="nofollow" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="" rel="nofollow" title="Youtube" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="" rel="nofollow" title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="" rel="nofollow" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="" rel="nofollow" title="RSS" target="_blank"><i class="fa fa-rss"></i></a></li>
                    </ul>
                    <!-- Tab links -->
                    <div class="marginBottom20" style="box-shadow: 0 2px 1px 1px #d5d5d5;">
                        @include('frontend.bn.layouts.latestPopularBox')
                    </div>
                    <div class="marginBottom20 en_bg">
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <a class="common-title-link" href="{{ url('/en') }}" target="_blank">ENGLISH</a>
                            </span>
                        </div>
                        <div class="cat-box-with-media default-height rem-first-border">
                            @foreach($englishContents as $content)
                                @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                <div class="media">
                                    <div class="media-left">
                                        <a href="{{ $sURL }}">
                                            @if($content->video_type == 1 && $content->video_id)
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                            @else
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="{{ $sURL }}">
                                                @if($content->content_sub_heading)
                                                    <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                                @endif
                                                {{ $content->content_heading }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            <!-- Category Section -->
            <div class="row marginBottom20">
                <div class="col-sm-9 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/national') }}">জাতীয়</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media rem-first-border ">
                        <div class="row">
                            @if($nationalContents)
                                <div class="col-sm-7">
                                    @php($nlMainContent = $nationalContents->shift())
                                    @if($nlMainContent)
                                        @php($sURL = fDesktopURL($nlMainContent->content_id, $nlMainContent->category->cat_slug, ($nlMainContent->subcategory->subcat_slug ?? null), $nlMainContent->content_type))
                                        <div class="cat-box">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    @if($nlMainContent->video_type == 1 && $nlMainContent->video_id)
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $spTopContent->video_id }}/hqdefault.jpg" class="lazyload img-responsive" alt="{{ $nlMainContent->content_heading }}">
                                                    @else
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $nlMainContent->img_bg_path ? asset(config('appconfig.contentImagePath').$nlMainContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="lazyload img-responsive" alt="{{ $nlMainContent->content_heading }}" title="{{ $nlMainContent->content_heading }}">
                                                    @endif
                                                    @if($content->video_id)
                                                        <div class="video-icon">
                                                            <i class="fa fa-video-camera"></i>
                                                        </div>
                                                    @endif
                                                </a>
                                            </div>
                                            <h3 class="leader">
                                                <a href="{{ $sURL }}">
                                                    @if($nlMainContent->content_sub_heading)
                                                        <b class="sub-heading">{{ $nlMainContent->content_sub_heading }}</b>
                                                    @endif
                                                    {{ $nlMainContent->content_heading }}
                                                </a>
                                            </h3>
                                            <p>{{ $nlMainContent->content_brief }}</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-5">
                                    <div class="cat-box-with-media default-height rem-first-border">
                                        @php($nlOtherContents = $nationalContents->all())
                                        @if($nlOtherContents)
                                            @foreach($nlOtherContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <div class="media">
                                                    <div class="media-left">
                                                        <div class="imgbox">
                                                            <a href="{{ $sURL }}">
                                                                @if($content->video_type == 1 && $content->video_id)
                                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                                                @else
                                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
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
                                                            <a href="{{ $sURL }}">
                                                                @if($content->content_sub_heading)
                                                                    <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                                                @endif
                                                                {{ $content->content_heading }}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div>
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <a class="common-title-link" href="{{ url('/politics') }}">রাজনীতি</a>
                            </span>
                        </div>
                        <div class="cat-box-with-media default-height rem-first-border marginBottom50">

                            @if($politicsContents)

                                @foreach($politicsContents as $content)

                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                    <div class="media">
                                        <div class="media-left">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    @if($content->video_type == 1 && $content->video_id)
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                                    @else
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
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
                                                <a href="{{ $sURL }}">
                                                    @if($content->content_sub_heading)
                                                        <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                @endforeach

                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <!-- 4 Category Section -->
            <div class="row marginBottom20">
                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/economy') }}">অর্থনীতি</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($economyContents)
                            @php($ecTopContent = $economyContents->shift())
                            @php($sURL = fDesktopURL($ecTopContent->content_id, $ecTopContent->category->cat_slug, ($ecTopContent->subcategory->subcat_slug ?? null), $ecTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($ecTopContent->video_type == 1 && $ecTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $ecTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $ecTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $ecTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$ecTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $ecTopContent->content_heading }}" title="{{ $ecTopContent->content_heading }}">
                                        @endif

                                        @if($ecTopContent->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($ecTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $ecTopContent->content_sub_heading }}</b>
                                        @endif
                                        {{ $ecTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($ecOtherContents = $economyContents->all())

                            @if($ecOtherContents)
                                @foreach($ecOtherContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>

                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/international') }}">আন্তর্জাতিক</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($internationalContents)
                            @php($intTopContent = $internationalContents->shift())
                            @php($sURL = fDesktopURL($intTopContent->content_id, $intTopContent->category->cat_slug, ($intTopContent->subcategory->subcat_slug ?? null), $intTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($intTopContent->video_type == 1 && $intTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $intTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $intTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $intTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$intTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $intTopContent->content_heading }}" title="{{ $intTopContent->content_heading }}">
                                        @endif

                                        @if($intTopContent->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($intTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $intTopContent->content_sub_heading }}</b>
                                        @endif
                                        {{ $intTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($intOtherContents = $internationalContents->all())

                            @if($intOtherContents)
                                @foreach($intOtherContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>

                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/literature') }}">সাহিত্য-সংস্কৃতি</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($literatureContents)
                            @php($ltTopContent = $literatureContents->shift())
                            @php($sURL = fDesktopURL($ltTopContent->content_id, $ltTopContent->category->cat_slug, ($ltTopContent->subcategory->subcat_slug ?? null), $ltTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($ltTopContent->video_type == 1 && $ltTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $ltTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $ltTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $ltTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$ltTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $ltTopContent->content_heading }}" title="{{ $ltTopContent->content_heading }}">
                                        @endif

                                        @if($ltTopContent->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($ltTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $ltTopContent->content_sub_heading }}</b>
                                        @endif
                                        {{ $ltTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($ltOtherContents = $literatureContents->all())

                            @if($ltOtherContents)
                                @foreach($ltOtherContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>

                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/lifestyle') }}">লাইফস্টাইল</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($lifestyleContents)
                            @php($lfTopContent = $lifestyleContents->shift())
                            @php($sURL = fDesktopURL($lfTopContent->content_id, $lfTopContent->category->cat_slug, ($lfTopContent->subcategory->subcat_slug ?? null), $lfTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($lfTopContent->video_type == 1 && $lfTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $lfTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $lfTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $lfTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$lfTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $lfTopContent->content_heading }}" title="{{ $lfTopContent->content_heading }}">
                                        @endif

                                        @if($lfTopContent->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($lfTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $lfTopContent->content_sub_heading }}</b>
                                        @endif
                                        {{ $lfTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($lfOtherContents = $lifestyleContents->all())

                            @if($lfOtherContents)
                                @foreach($lfOtherContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>

            </div>

            <!-- Category Section -->
            <div class="row marginBottom20">
                <div class="col-sm-9 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/sports') }}">খেলা</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media rem-first-border ">
                        <div class="row">
                            @if($sportsContents)
                                <div class="col-sm-7">
                                    @php($spTopContent = $sportsContents->shift())
                                    @if($spTopContent)
                                        @php($sURL = fDesktopURL($spTopContent->content_id, $spTopContent->category->cat_slug, ($spTopContent->subcategory->subcat_slug ?? null), $spTopContent->content_type))
                                        <div class="cat-box">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    @if($spTopContent->video_type == 1 && $spTopContent->video_id)
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $spTopContent->video_id }}/hqdefault.jpg" class="lazyload img-responsive" alt="{{ $spTopContent->content_heading }}">
                                                    @else
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $spTopContent->img_bg_path ? asset(config('appconfig.contentImagePath').$spTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="lazyload img-responsive" alt="{{ $spTopContent->content_heading }}" title="{{ $spTopContent->content_heading }}">
                                                    @endif
                                                    @if($content->video_id)
                                                        <div class="video-icon">
                                                            <i class="fa fa-video-camera"></i>
                                                        </div>
                                                    @endif
                                                </a>
                                            </div>
                                            <h3 class="leader">
                                                <a href="{{ $sURL }}">
                                                    @if($spTopContent->content_sub_heading)
                                                        <b class="sub-heading">{{ $spTopContent->content_sub_heading }}</b>
                                                    @endif
                                                    {{ $spTopContent->content_heading }}
                                                </a>
                                            </h3>
                                            <p>{{ $spTopContent->content_brief }}</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-5">
                                    <div class="cat-box-with-media default-height rem-first-border">
                                        @php($spOtherContents = $sportsContents->all())
                                        @if($spOtherContents)
                                            @foreach($spOtherContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <div class="media">
                                                    <div class="media-left">
                                                        <div class="imgbox">
                                                            <a href="{{ $sURL }}">
                                                                @if($content->video_type == 1 && $content->video_id)
                                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                                                @else
                                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
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
                                                            <a href="{{ $sURL }}">
                                                                @if($content->content_sub_heading)
                                                                    <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                                                @endif
                                                                {{ $content->content_heading }}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 marginBottom50">
                    <div>
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <a class="common-title-link" href="{{ url('/health') }}">স্বাস্থ্য</a>
                            </span>
                        </div>
                        <div class="cat-box-with-media default-height rem-first-border marginBottom50">

                            @if($healthContents)

                                @foreach($healthContents as $content)

                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                    <div class="media">
                                        <div class="media-left">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    @if($content->video_type == 1 && $content->video_id)
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                                    @else
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
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
                                                <a href="{{ $sURL }}">
                                                    @if($content->content_sub_heading)
                                                        <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                @endforeach

                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <!-- 4 Category Section -->
            <div class="row marginBottom20">
                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/technology') }}">তথ্যপ্রযুক্তি</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($technologyContents)
                            @php($tecTopContent = $technologyContents->shift())
                            @php($sURL = fDesktopURL($tecTopContent->content_id, $tecTopContent->category->cat_slug, ($tecTopContent->subcategory->subcat_slug ?? null), $tecTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($tecTopContent->video_type == 1 && $tecTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $tecTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $tecTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $tecTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$tecTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $tecTopContent->content_heading }}" title="{{ $tecTopContent->content_heading }}">
                                        @endif

                                        @if($tecTopContent->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($tecTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $tecTopContent->content_sub_heading }}</b>
                                        @endif
                                        {{ $tecTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($tecOtherContents = $technologyContents->all())

                            @if($tecOtherContents)
                                @foreach($tecOtherContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/education') }}">শিক্ষা</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($educationContents)
                            @php($eduTopContent = $educationContents->shift())
                            @php($sURL = fDesktopURL($eduTopContent->content_id, $eduTopContent->category->cat_slug, ($eduTopContent->subcategory->subcat_slug ?? null), $eduTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($eduTopContent->video_type == 1 && $eduTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $eduTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $eduTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $eduTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$eduTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $eduTopContent->content_heading }}" title="{{ $eduTopContent->content_heading }}">
                                        @endif

                                        @if($eduTopContent->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($eduTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $eduTopContent->content_sub_heading }}</b>
                                        @endif
                                        {{ $eduTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($eduOtherContents = $educationContents->all())

                            @if($eduOtherContents)
                                @foreach($eduOtherContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/career') }}">ক্যারিয়ার</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($careerContents)
                            @php($careerTopContent = $careerContents->shift())
                            @php($sURL = fDesktopURL($careerTopContent->content_id, $careerTopContent->category->cat_slug, ($careerTopContent->subcategory->subcat_slug ?? null), $careerTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($careerTopContent->video_type == 1 && $careerTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $careerTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $careerTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $careerTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$careerTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $careerTopContent->content_heading }}" title="{{ $careerTopContent->content_heading }}">
                                        @endif

                                        @if($careerTopContent->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($careerTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $careerTopContent->content_sub_heading }}</b>
                                        @endif
                                        {{ $careerTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($careerOtherContents = $careerContents->all())

                            @if($careerOtherContents)
                                @foreach($careerOtherContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/horoscope') }}">রাশিফল</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($horoscopeContents)
                            @php($horoscTopContent = $horoscopeContents->shift())
                            @php($sURL = fDesktopURL($horoscTopContent->content_id, $horoscTopContent->category->cat_slug, ($horoscTopContent->subcategory->subcat_slug ?? null), $horoscTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($horoscTopContent->video_type == 1 && $horoscTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $horoscTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $horoscTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $horoscTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$horoscTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $horoscTopContent->content_heading }}" title="{{ $horoscTopContent->content_heading }}">
                                        @endif

                                        @if($horoscTopContent->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($horoscTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $horoscTopContent->content_sub_heading }}</b>
                                        @endif
                                        {{ $horoscTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($horoscOtherContents = $horoscopeContents->all())

                            @if($horoscOtherContents)
                                @foreach($careerOtherContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Category Section -->
            <div class="row marginBottom20">
                <div class="col-sm-9 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/entertainment') }}">বিনোদন</a>
                        </span>
                    </div>

                    <div class="cat-box-with-media">

                        @if($entertainmentContents)
                            <div class="row">
                                <div class="col-sm-6">

                                    @php($entTopContent = $entertainmentContents->shift())

                                    @if($entTopContent)
                                        @php($sURL = fDesktopURL($entTopContent->content_id, $entTopContent->category->cat_slug, ($entTopContent->subcategory->subcat_slug ?? null), $entTopContent->content_type))

                                        <div class="cat-box">
                                            <a href="{{ $sURL }}">
                                                @if($entTopContent->video_type == 1 && $entTopContent->video_id)
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $entTopContent->video_id }}/hqdefault.jpg" class="lazyload img-responsive" alt="{{ $entTopContent->content_heading }}">
                                                @else
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $entTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$entTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $entTopContent->content_heading }}" title="{{ $entTopContent->content_heading }}">
                                                @endif

                                                @if($entTopContent->video_id)
                                                    <div class="video-icon">
                                                        <i class="fa fa-video-camera"></i>
                                                    </div>
                                                @endif
                                            </a>
                                            <h3 class="leader">
                                                <a href="{{ $sURL }}">
                                                    @if($entTopContent->content_sub_heading)
                                                        <b class="sub-heading">{{ $entTopContent->content_sub_heading }}</b>
                                                    @endif
                                                    {{ $entTopContent->content_heading }}
                                                </a>
                                            </h3>
                                            <p>{{ $entTopContent->content_brief }}</p>
                                        </div>

                                    @endif

                                </div>

                                <div class="col-sm-6">
                                    <div class="row FlexRow">
                                        @php($entOtherContents = $entertainmentContents->all())

                                        @if($entOtherContents)

                                            @foreach($entOtherContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <div class="col-xs-6">
                                                    <div class="cat-box-sub">
                                                        <div class="imgbox">
                                                            <a href="{{ $sURL }}">
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
                                                        <h3>
                                                            <a href="{{ $sURL }}">
                                                                @if($content->content_sub_heading)
                                                                    <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                                                @endif
                                                                {{ $content->content_heading }}
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </div>

                                            @endforeach

                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-3 marginBottom50">
                    <div>
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <a class="common-title-link" href="{{ url('/islamic-life') }}">ইসলামিক জীবন</a>
                            </span>
                        </div>
                        <div class="cat-box-with-media default-height rem-first-border">

                            @if($islamContents)

                                @foreach($islamContents as $content)

                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                    <div class="media">
                                        <div class="media-left">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    @if($content->video_type == 1 && $content->video_id)
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                                    @else
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
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
                                                <a href="{{ $sURL }}">
                                                    @if($content->content_sub_heading)
                                                        <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                @endforeach

                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Section -->
            <div class="row marginBottom50">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/feature') }}">ফিচার</a>
                        </span>
                    </div>
                    <div class="well custom-well">
                        <div class="row FlexRow">

                            @if($featureContents)

                                @foreach($featureContents as $content)

                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                    <div class="col-sm-2">
                                        <div class="cat-box-sub">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    @if($content->video_type == 1 && $content->video_id)
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                                    @else
                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                    @endif

                                                    @if($content->video_id)
                                                        <div class="video-icon">
                                                            <i class="fa fa-video-camera"></i>
                                                        </div>
                                                    @endif
                                                </a>
                                            </div>
                                            <h3>
                                                <a href="{{ $sURL }}">
                                                    @if($content->content_sub_heading)
                                                        <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </a>
                                            </h3>
                                        </div>
                                    </div>

                                @endforeach

                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <!-- 4 category sections -->
            <div class="row marginBottom20">
                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/interview') }}">সাক্ষাৎকার</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($interviewContents)
                            @php($interviewTopContent = $interviewContents->shift())
                            @php($sURL = fDesktopURL($interviewTopContent->content_id, $interviewTopContent->category->cat_slug, ($interviewTopContent->subcategory->subcat_slug ?? null), $interviewTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($interviewTopContent->video_type == 1 && $interviewTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $interviewTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $interviewTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $interviewTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$interviewTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $interviewTopContent->content_heading }}" title="{{ $interviewTopContent->content_heading }}">
                                        @endif

                                        @if($interviewTopContent->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($interviewTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $interviewTopContent->content_sub_heading }}</b>
                                        @endif
                                        {{ $interviewTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($interviewOtherContents = $interviewContents->all())

                            @if($interviewOtherContents)
                                @foreach($interviewOtherContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/district-upozilla') }}">জেলা উপজেলা</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($disUpozContents)
                            @php($disUpoTopContent = $disUpozContents->shift())
                            @php($sURL = fDesktopURL($disUpoTopContent->content_id, $disUpoTopContent->category->cat_slug, ($disUpoTopContent->subcategory->subcat_slug ?? null), $disUpoTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($disUpoTopContent->video_type == 1 && $disUpoTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $disUpoTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $disUpoTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $disUpoTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$disUpoTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $disUpoTopContent->content_heading }}" title="{{ $disUpoTopContent->content_heading }}">
                                        @endif

                                        @if($disUpoTopContent->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($disUpoTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $disUpoTopContent->content_sub_heading }}</b>
                                        @endif
                                        {{ $disUpoTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($distUpozOtherContents = $disUpozContents->all())

                            @if($distUpozOtherContents)
                                @foreach($distUpozOtherContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/tourism') }}">পর্যটন</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($tourismContents)
                            @php($tourismTopContent = $tourismContents->shift())
                            @php($sURL = fDesktopURL($tourismTopContent->content_id, $tourismTopContent->category->cat_slug, ($tourismTopContent->subcategory->subcat_slug ?? null), $tourismTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($tourismTopContent->video_type == 1 && $tourismTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $tourismTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $tourismTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $tourismTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$tourismTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $tourismTopContent->content_heading }}" title="{{ $tourismTopContent->content_heading }}">
                                        @endif

                                        @if($tourismTopContent->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($tourismTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $tourismTopContent->content_sub_heading }}</b>
                                        @endif
                                        {{ $tourismTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($tourismOtherContents = $tourismContents->all())

                            @if($tourismOtherContents)
                                @foreach($tourismOtherContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">{{ $content->content_heading }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-sm-3 marginBottom50">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <span class="common-title-link">Follow us</span>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 Padding_top20">
                            <div class="fb-page" data-href="https://www.facebook.com/dhakaprokashmk" data-height="458" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/dhakaprokashmk" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/dhakaprokashmk">Dhakaprokash</a></blockquote></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="{{ asset('frontend-assets/plugins/marquee/marquee.js') }}"></script>
    <script>
        // marquee js
        $('.marquee').marquee({
            pauseOnHover: true,
            duration: 15000
        });
    </script>
@endsection