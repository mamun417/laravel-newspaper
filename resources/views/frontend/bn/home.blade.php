@extends('frontend.bn.app')

@section('title', cache('bnSiteSettings')->title)

@section('mainContent')

    <div class="main-content">
        <div class="container my-4">
            {{-- Marquee/scroll news --}}
            @include('frontend.bn.common.breaking-marquee')
            <!-- Top Section -->
            <div class="row marginBottom50">
                <div class="col-sm-9 mb-3">
                    @if($specialTopContents)
                    <div class="row mx-n2">
                        @php($spTopContent = $specialTopContents->shift())
                        <div class="col-sm-8 pl-2">
                            @if($spTopContent)

                                @php($sURL = fDesktopURL($spTopContent->content_id, $spTopContent->category->cat_slug, ($spTopContent->subcategory->subcat_slug ?? null), $spTopContent->content_type))

                                <div class="position-relative mb-3 pb-4 mLead">
                                    <a href="{{ $sURL }}" title="{{ $spTopContent->content_heading }}" class="text-dark link">
                                    <figure class="figure mb-0">
                                        @if($spTopContent->video_type == 1 && $spTopContent->video_id)
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $spTopContent->video_id }}/hqdefault.jpg" class="lazyload img-responsive" alt="{{ $spTopContent->content_heading }}">
                                        @else
                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $spTopContent->img_bg_path ? asset(config('appconfig.contentImagePath').$spTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="lazyload img-responsive" alt="{{ $spTopContent->content_heading }}" title="{{ $spTopContent->content_heading }}">
                                        @endif
                                    </figure>
                                    <h4 class="pt-2 font-weight-bold">{{ $spTopContent->content_heading }}</h4>
                                </a>
                                <p class="pt-1 d-none d-sm-block">{{ fGetWord(fFormatString($spTopContent->content_details), 40) }}</p>
                            </div>
                            @endif
                        </div>
                        @endif

                        @php($spTopRightTwoContents = $specialTopContents->splice(0,5))
                        <div class="col-sm-4 px-1">
                            @if($spTopRightTwoContents->count() > 0)
                                @foreach($spTopRightTwoContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                    <div class="list-unstyled">
                                        <a href="{{ $sURL }}" title="{{ $content->content_heading }}" class="media mb-2 pb-2 border-bottom text-dark link">
                                        <div class="w-50 mr-2">
                                            <figure class="figure mb-0">
                                                @if($content->video_type == 1 && $content->video_id)
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/mqdefault.jpg" class="lazyload img-responsive" alt="{{ $content->content_heading }}">
                                                @else
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                @endif
                                            </figure>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="font-weight-bold mb-1">{{ $content->content_heading }}</h6>
                                        </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <!-- Tab links -->
                    @include('frontend.bn.layouts.latestPopularBox')

                </div>
            </div>

            <!-- Category Section -->
            <div class="row marginBottom20">
                <div class="container my-4">
                    <div class="row">
                        @if($nationalContents)
                            <div class="col-sm-6 col-md-4 col-12 mb-5 d-flex">
                                @php($nlMainContent = $nationalContents->shift())
                                @if($nlMainContent)
                                    @php($sURL = fDesktopURL($nlMainContent->content_id, $nlMainContent->category->cat_slug, ($nlMainContent->subcategory->subcat_slug ?? null), $nlMainContent->content_type))

                                    <div class="border p-4 m-p-0 m-border-0 position-relative w-100">
                                        <h2 class="rakSab-common-cat-title"><a href="{{ url($nlMainContent->category->cat_slug) }}">{{ $nlMainContent->category->cat_name_bn }}</a></h2>
                                        <a href="{{ $sURL }}" class="link">
                                            <figure class="figure mb-0">
                                                @if($nlMainContent->video_type == 1 && $nlMainContent->video_id)
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $spTopContent->video_id }}/hqdefault.jpg" class="lazyload img-responsive" alt="{{ $nlMainContent->content_heading }}">
                                                @else
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $nlMainContent->img_bg_path ? asset(config('appconfig.contentImagePath').$nlMainContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="lazyload img-responsive" alt="{{ $nlMainContent->content_heading }}" title="{{ $nlMainContent->content_heading }}">
                                                @endif
                                                @if(isset($content) AND $content->video_id)
                                                    <div class="video-icon">
                                                        <i class="fa fa-video-camera"></i>
                                                    </div>
                                                @endif
                                            </figure>
                                            <h5 class="text-dark mt-2">{{ $nlMainContent->content_heading }}</h5>
                                        </a>

                                        <div class="row mb-4 mx-n2">
                                            @php($nlOtherContents = $nationalContents->all())
                                            @if($nlOtherContents)
                                                @foreach($nlOtherContents as $content)
                                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                    <div class="col-sm-6 col-12 mb-2 px-2">
                                                        <div class="link d-flex d-sm-block d-md-block d-lg-block d-xl-block">
                                                            <a href="{{ $sURL }}" class="d-block moblie-pr-2 moblie-w-50">
                                                                <figure class="figure mb-2">
                                                                    @if($content->video_type == 1 && $content->video_id)
                                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $content->content_heading }}">
                                                                    @else
                                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                                    @endif

                                                                    @if($content->video_id)
                                                                        <div class="video-icon">
                                                                            <i class="fa fa-video-camera"></i>
                                                                        </div>
                                                                    @endif
                                                                </figure>
                                                            </a>
                                                            <h6 class="pt-0 moblie-w-50 font-weight-bold">
                                                                <a href="{{ $sURL }}" class="text-dark">{{ $content->content_heading }}</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <a href="{{ url($nlMainContent->category->cat_slug) }}" class="bg-light text-center py-2 text-theme more">আরও</a>
                                    </div>
                                @endif
                            </div>
                        @endif


                        @if($islamContents)
                            <div class="col-sm-6 col-md-4 col-12 mb-5 d-flex">
                                @php($islamContent = $islamContents->shift())
                                @if($islamContent)
                                    @php($sURL = fDesktopURL($islamContent->content_id, $islamContent->category->cat_slug, ($islamContent->subcategory->subcat_slug ?? null), $islamContent->content_type))
                                    <div class="border p-4 m-p-0 m-border-0 position-relative w-100">
                                        <h2 class="rakSab-common-cat-title"><a href="{{ url($islamContent->category->cat_slug) }}">{{ $islamContent->category->cat_name_bn }}</a></h2>
                                        <a href="{{ $sURL }}" class="link">
                                            <figure class="figure mb-0">
                                                @if($islamContent->video_type == 1 && $islamContent->video_id)
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $islamContent->video_id }}/hqdefault.jpg" class="lazyload img-responsive" alt="{{ $islamContent->content_heading }}">
                                                @else
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $islamContent->img_bg_path ? asset(config('appconfig.contentImagePath').$islamContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="lazyload img-responsive" alt="{{ $islamContent->content_heading }}" title="{{ $islamContent->content_heading }}">
                                                @endif
                                                @if($content->video_id)
                                                    <div class="video-icon">
                                                        <i class="fa fa-video-camera"></i>
                                                    </div>
                                                @endif
                                            </figure>
                                            <h5 class="text-dark mt-2">{{ $islamContent->content_heading }}</h5>
                                        </a>

                                        <div class="row mb-4 mx-n2">
                                            @php($islamOtherContents = $islamContents->all())
                                            @if($islamOtherContents)
                                                @foreach($islamOtherContents as $content)
                                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                    <div class="col-sm-6 col-12 mb-2 px-2">
                                                        <div class="link d-flex d-sm-block d-md-block d-lg-block d-xl-block">
                                                            <a href="{{ $sURL }}" class="d-block moblie-pr-2 moblie-w-50">
                                                                <figure class="figure mb-2">
                                                                    @if($content->video_type == 1 && $content->video_id)
                                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $content->content_heading }}">
                                                                    @else
                                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                                    @endif

                                                                    @if($content->video_id)
                                                                        <div class="video-icon">
                                                                            <i class="fa fa-video-camera"></i>
                                                                        </div>
                                                                    @endif
                                                                </figure>
                                                            </a>
                                                            <h6 class="pt-0 moblie-w-50 font-weight-bold">
                                                                <a href="{{ $sURL }}" class="text-dark">{{ $content->content_heading }}</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <a href="{{ url($islamContent->category->cat_slug) }}" class="bg-light text-center py-2 text-theme more">আরও</a>
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if($entertainmentContents)
                            <div class="col-sm-6 col-md-4 col-12 mb-5 d-flex">
                                @php($entTopContent = $entertainmentContents->shift())
                                @if($entTopContent)
                                    @php($sURL = fDesktopURL($entTopContent->content_id, $entTopContent->category->cat_slug, ($entTopContent->subcategory->subcat_slug ?? null), $entTopContent->content_type))
                                    <div class="border p-4 m-p-0 m-border-0 position-relative w-100">
                                        <h2 class="rakSab-common-cat-title"><a href="{{ url('/sports') }}">বিনোদন</a></h2>
                                        <a href="{{ $sURL }}" class="link">
                                            <figure class="figure mb-0">
                                                @if($entTopContent->video_type == 1 && $entTopContent->video_id)
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $entTopContent->video_id }}/hqdefault.jpg" class="lazyload img-responsive" alt="{{ $entTopContent->content_heading }}">
                                                @else
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $entTopContent->img_bg_path ? asset(config('appconfig.contentImagePath').$entTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="lazyload img-responsive" alt="{{ $entTopContent->content_heading }}" title="{{ $entTopContent->content_heading }}">
                                                @endif
                                                @if($content->video_id)
                                                    <div class="video-icon">
                                                        <i class="fa fa-video-camera"></i>
                                                    </div>
                                                @endif
                                            </figure>
                                            <h5 class="text-dark mt-2">{{ $entTopContent->content_heading }}</h5>
                                        </a>

                                        <div class="row mb-4 mx-n2">
                                            @php($entOtherContents = $entertainmentContents->all())
                                            @if($entOtherContents)
                                                @foreach($entOtherContents as $content)
                                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                    <div class="col-sm-6 col-12 mb-2 px-2">
                                                        <div class="link d-flex d-sm-block d-md-block d-lg-block d-xl-block">
                                                            <a href="{{ $sURL }}" class="d-block moblie-pr-2 moblie-w-50">
                                                                <figure class="figure mb-2">
                                                                    @if($content->video_type == 1 && $content->video_id)
                                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $content->content_heading }}">
                                                                    @else
                                                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                                    @endif

                                                                    @if($content->video_id)
                                                                        <div class="video-icon">
                                                                            <i class="fa fa-video-camera"></i>
                                                                        </div>
                                                                    @endif
                                                                </figure>
                                                            </a>
                                                            <h6 class="pt-0 moblie-w-50 font-weight-bold">
                                                                <a href="{{ $sURL }}" class="text-dark">{{ $content->content_heading }}</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <a href="{{ url('/entertainment') }}" class="bg-light text-center py-2 text-theme more">আরও</a>
                                    </div>
                                @endif
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="bg-light-green pt-5">
                <div class="container">
                    <div class="row">

                        <div class="col-sm-3 mb-5 d-flex">
                            <div class="border-bottom pb-2 position-relative w-100">

                                @if($economyContents)
                                    @php($ecTopContent = $economyContents->shift())
                                    @php($sURL = fDesktopURL($ecTopContent->content_id, $ecTopContent->category->cat_slug, ($ecTopContent->subcategory->subcat_slug ?? null), $ecTopContent->content_type))
                                    <h2 class="rakSab-common-cat-title"><a href="{{ url($ecTopContent->category->cat_slug) }}">{{ $ecTopContent->category->cat_name_bn }}</a></h2>
                                    <a href="{{ $sURL }}" class="link">
                                        <figure class="figure mb-0">
                                            @if($ecTopContent->video_type == 1 && $ecTopContent->video_id)
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $ecTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $ecTopContent->content_heading }}">
                                            @else
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $ecTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$ecTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $ecTopContent->content_heading }}" title="{{ $ecTopContent->content_heading }}">
                                            @endif

                                            @if($ecTopContent->video_id)
                                                <div class="video-icon">
                                                    <i class="fa fa-video-camera"></i>
                                                </div>
                                            @endif
                                        </figure>
                                        <h5 class="text-dark mt-2">{{ $ecTopContent->content_heading }}</h5>
                                    </a>

                                    @php($ecOtherContents = $economyContents->all())
                                    @if($ecOtherContents)
                                        <ul class="list-unstyled mb-5">
                                            @foreach($ecOtherContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <li class="pt-2 pb-2 border-top "><a href="{{ $sURL }}" class="text-dark link">{{ $content->content_heading }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <a href="{{ url($ecTopContent->category->cat_slug) }}" class="bg-light text-center py-2 text-theme more">আরও</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3 mb-5 d-flex">
                            <div class="border-bottom pb-2 position-relative w-100">

                                @if($internationalContents)
                                    @php($intTopContent = $internationalContents->shift())
                                    @php($sURL = fDesktopURL($intTopContent->content_id, $intTopContent->category->cat_slug, ($intTopContent->subcategory->subcat_slug ?? null), $intTopContent->content_type))
                                    <h2 class="rakSab-common-cat-title"><a href="{{ url($intTopContent->category->cat_slug) }}">{{ $intTopContent->category->cat_name_bn }}</a></h2>
                                    <a href="{{ $sURL }}" class="link">
                                        <figure class="figure mb-0">
                                            @if($intTopContent->video_type == 1 && $intTopContent->video_id)
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $intTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $intTopContent->content_heading }}">
                                            @else
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $intTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$intTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $intTopContent->content_heading }}" title="{{ $intTopContent->content_heading }}">
                                            @endif

                                            @if($intTopContent->video_id)
                                                <div class="video-icon">
                                                    <i class="fa fa-video-camera"></i>
                                                </div>
                                            @endif
                                        </figure>
                                        <h5 class="text-dark mt-2">{{ $intTopContent->content_heading }}</h5>
                                    </a>

                                    @php($intOtherContents = $internationalContents->all())

                                    @if($intOtherContents)
                                        <ul class="list-unstyled mb-5">
                                            @foreach($intOtherContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <li class="pt-2 pb-2 border-top "><a href="{{ $sURL }}" class="text-dark link">{{ $content->content_heading }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <a href="{{ url($intTopContent->category->cat_slug) }}" class="bg-light text-center py-2 text-theme more">আরও</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3 mb-5 d-flex">
                            <div class="border-bottom pb-2 position-relative w-100">

                                @if($literatureContents)
                                    @php($ltTopContent = $literatureContents->shift())
                                    @php($sURL = fDesktopURL($ltTopContent->content_id, $ltTopContent->category->cat_slug, ($ltTopContent->subcategory->subcat_slug ?? null), $ltTopContent->content_type))
                                    <h2 class="rakSab-common-cat-title"><a href="{{ url($ltTopContent->category->cat_slug) }}">{{ $ltTopContent->category->cat_name_bn }}</a></h2>
                                    <a href="{{ $sURL }}" class="link">
                                        <figure class="figure mb-0">
                                            @if($ltTopContent->video_type == 1 && $ltTopContent->video_id)
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $ltTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $ltTopContent->content_heading }}">
                                            @else
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $ltTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$ltTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $ltTopContent->content_heading }}" title="{{ $ltTopContent->content_heading }}">
                                            @endif

                                            @if($ltTopContent->video_id)
                                                <div class="video-icon">
                                                    <i class="fa fa-video-camera"></i>
                                                </div>
                                            @endif
                                        </figure>
                                        <h5 class="text-dark mt-2">{{ $ltTopContent->content_heading }}</h5>
                                    </a>

                                    @php($ltOtherContents = $literatureContents->all())

                                    @if($ltOtherContents)
                                        <ul class="list-unstyled mb-5">
                                            @foreach($ltOtherContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <li class="pt-2 pb-2 border-top "><a href="{{ $sURL }}" class="text-dark link">{{ $content->content_heading }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <a href="{{ url($ltTopContent->category->cat_slug) }}" class="bg-light text-center py-2 text-theme more">আরও</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3 mb-5 d-flex">
                            <div class="border-bottom pb-2 position-relative w-100">

                                @if($lifestyleContents)
                                    @php($lfTopContent = $lifestyleContents->shift())
                                    @php($sURL = fDesktopURL($lfTopContent->content_id, $lfTopContent->category->cat_slug, ($lfTopContent->subcategory->subcat_slug ?? null), $lfTopContent->content_type))
                                    <h2 class="rakSab-common-cat-title"><a href="{{ url($lfTopContent->category->cat_slug) }}">{{ $lfTopContent->category->cat_name_bn }}</a></h2>
                                    <a href="{{ $sURL }}" class="link">
                                        <figure class="figure mb-0">
                                            @if($lfTopContent->video_type == 1 && $lfTopContent->video_id)
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $lfTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $lfTopContent->content_heading }}">
                                            @else
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $lfTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$lfTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $lfTopContent->content_heading }}" title="{{ $lfTopContent->content_heading }}">
                                            @endif

                                            @if($lfTopContent->video_id)
                                                <div class="video-icon">
                                                    <i class="fa fa-video-camera"></i>
                                                </div>
                                            @endif
                                        </figure>
                                        <h5 class="text-dark mt-2">{{ $lfTopContent->content_heading }}</h5>
                                    </a>

                                    @php($lfOtherContents = $lifestyleContents->all())

                                    @if($lfOtherContents)
                                        <ul class="list-unstyled mb-5">
                                            @foreach($lfOtherContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <li class="pt-2 pb-2 border-top "><a href="{{ $sURL }}" class="text-dark link">{{ $content->content_heading }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <a href="{{ url($lfTopContent->category->cat_slug) }}" class="bg-light text-center py-2 text-theme more">আরও</a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="my-5">
                    @if($sportsContentsNew)
                        @php($spTopContent = $sportsContents->shift())
                        <h2 class="rakSab-common-cat-title"><a href="{{ url($spTopContent->category->cat_slug) }}">{{ $spTopContent->category->cat_name_bn }}</a></h2>
                    @endif
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="p-4 border m-p-o m-border-0">
                                <div class="row">

                                    @if($sportsContentsNew)
                                        <div class="col-sm-4 mb-3">
                                            @php($spTopContent = $sportsContents->shift())
                                            @if($spTopContent)
                                                @php($sURL = fDesktopURL($spTopContent->content_id, $spTopContent->category->cat_slug, ($spTopContent->subcategory->subcat_slug ?? null), $spTopContent->content_type))
                                                <div class="link">
                                                    <a href="{{ $sURL }}" class="d-block">
                                                        <figure class="figure mb-0">
                                                            @if($spTopContent->video_type == 1 && $spTopContent->video_id)
                                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $spTopContent->video_id }}/hqdefault.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $spTopContent->content_heading }}">
                                                            @else
                                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $spTopContent->img_bg_path ? asset(config('appconfig.contentImagePath').$spTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="lazyload img-responsive w-100 mb-2" alt="{{ $spTopContent->content_heading }}" title="{{ $spTopContent->content_heading }}">
                                                            @endif
                                                            @if($content->video_id)
                                                                <div class="video-icon">
                                                                    <i class="fa fa-video-camera"></i>
                                                                </div>
                                                            @endif
                                                        </figure>
                                                    </a>
                                                    <h5 class="my-2 font-weight-bold"><a href="" class="text-dark">{{ $spTopContent->content_heading }}</a></h5>
                                                    <p>{{ $spTopContent->content_brief }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="row">

                                                @php($spOtherContents = $sportsContentsNew->all())

                                                @if($spOtherContents)
                                                    @foreach($spOtherContents as $content)
                                                        @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                                        <div class="col-sm-4 col-6 mb-3">
                                                            <div class="link">
                                                                <a href="{{ $sURL }}" class="d-block">
                                                                    <figure class="figure mb-0">
                                                                        @if($content->video_type == 1 && $content->video_id)
                                                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $content->content_heading }}">
                                                                        @else
                                                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                                        @endif

                                                                        @if($content->video_id)
                                                                            <div class="video-icon">
                                                                                <i class="fa fa-video-camera"></i>
                                                                            </div>
                                                                        @endif
                                                                    </figure>
                                                                </a>
                                                                <h6 class="mt-2 font-weight-bold">
                                                                    <a href="{{ $sURL }}" class="text-dark">{{ $content->content_heading }}</a>
                                                                </h6>
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
                    </div>
                </div>
            </div>

            <div class="bg-light-green pt-5">
                <div class="container">
                    <div class="row">

                        <div class="col-sm-3 mb-5 d-flex">
                            <div class="border-bottom pb-2 position-relative w-100">

                                @if($technologyContents)
                                    @php($tecTopContent = $technologyContents->shift())
                                    @php($sURL = fDesktopURL($tecTopContent->content_id, $tecTopContent->category->cat_slug, ($tecTopContent->subcategory->subcat_slug ?? null), $tecTopContent->content_type))
                                    <h2 class="rakSab-common-cat-title"><a href="{{ url($tecTopContent->category->cat_slug) }}">{{ $tecTopContent->category->cat_name_bn }}</a></h2>
                                    <a href="{{ $sURL }}" class="link">
                                        <figure class="figure mb-0">
                                            @if($tecTopContent->video_type == 1 && $tecTopContent->video_id)
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $tecTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $tecTopContent->content_heading }}">
                                            @else
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $tecTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$tecTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $tecTopContent->content_heading }}" title="{{ $tecTopContent->content_heading }}">
                                            @endif

                                            @if($tecTopContent->video_id)
                                                <div class="video-icon">
                                                    <i class="fa fa-video-camera"></i>
                                                </div>
                                            @endif
                                        </figure>
                                        <h5 class="text-dark mt-2">{{ $tecTopContent->content_heading }}</h5>
                                    </a>

                                    @php($tecOtherContents = $technologyContents->all())
                                    @if($tecOtherContents)
                                        <ul class="list-unstyled mb-5">
                                            @foreach($tecOtherContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <li class="pt-2 pb-2 border-top "><a href="{{ $sURL }}" class="text-dark link">{{ $content->content_heading }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <a href="{{ url($tecTopContent->category->cat_slug) }}" class="bg-light text-center py-2 text-theme more">আরও</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3 mb-5 d-flex">
                            <div class="border-bottom pb-2 position-relative w-100">

                                @if($educationContents)
                                    @php($eduTopContent = $educationContents->shift())
                                    @php($sURL = fDesktopURL($eduTopContent->content_id, $eduTopContent->category->cat_slug, ($eduTopContent->subcategory->subcat_slug ?? null), $eduTopContent->content_type))
                                    <h2 class="rakSab-common-cat-title"><a href="{{ url($eduTopContent->category->cat_slug) }}">{{ $eduTopContent->category->cat_name_bn }}</a></h2>
                                    <a href="{{ $sURL }}" class="link">
                                        <figure class="figure mb-0">
                                            @if($eduTopContent->video_type == 1 && $eduTopContent->video_id)
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $eduTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $eduTopContent->content_heading }}">
                                            @else
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $eduTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$eduTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $eduTopContent->content_heading }}" title="{{ $eduTopContent->content_heading }}">
                                            @endif

                                            @if($eduTopContent->video_id)
                                                <div class="video-icon">
                                                    <i class="fa fa-video-camera"></i>
                                                </div>
                                            @endif
                                        </figure>
                                        <h5 class="text-dark mt-2">{{ $eduTopContent->content_heading }}</h5>
                                    </a>

                                    @php($eduOtherContents = $educationContents->all())

                                    @if($eduOtherContents)
                                        <ul class="list-unstyled mb-5">
                                            @foreach($eduOtherContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <li class="pt-2 pb-2 border-top "><a href="{{ $sURL }}" class="text-dark link">{{ $content->content_heading }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <a href="{{ url($eduTopContent->category->cat_slug) }}" class="bg-light text-center py-2 text-theme more">আরও</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3 mb-5 d-flex">
                            <div class="border-bottom pb-2 position-relative w-100">

                                @if($careerContents)
                                    @php($careerTopContent = $careerContents->shift())
                                    @php($sURL = fDesktopURL($careerTopContent->content_id, $careerTopContent->category->cat_slug, ($careerTopContent->subcategory->subcat_slug ?? null), $careerTopContent->content_type))
                                    <h2 class="rakSab-common-cat-title"><a href="{{ url($careerTopContent->category->cat_slug) }}">{{ $careerTopContent->category->cat_name_bn }}</a></h2>
                                    <a href="{{ $sURL }}" class="link">
                                        <figure class="figure mb-0">
                                            @if($careerTopContent->video_type == 1 && $careerTopContent->video_id)
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $careerTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $careerTopContent->content_heading }}">
                                            @else
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $careerTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$careerTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $careerTopContent->content_heading }}" title="{{ $careerTopContent->content_heading }}">
                                            @endif

                                            @if($careerTopContent->video_id)
                                                <div class="video-icon">
                                                    <i class="fa fa-video-camera"></i>
                                                </div>
                                            @endif
                                        </figure>
                                        <h5 class="text-dark mt-2">{{ $careerTopContent->content_heading }}</h5>
                                    </a>

                                    @php($careerOtherContents = $careerContents->all())

                                    @if($careerOtherContents)
                                        <ul class="list-unstyled mb-5">
                                            @foreach($careerOtherContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <li class="pt-2 pb-2 border-top "><a href="{{ $sURL }}" class="text-dark link">{{ $content->content_heading }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <a href="{{ url($careerTopContent->category->cat_slug) }}" class="bg-light text-center py-2 text-theme more">আরও</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3 mb-5 d-flex">
                            <div class="border-bottom pb-2 position-relative w-100">

                                @if($horoscopeContents)
                                    @php($horoscTopContent = $horoscopeContents->shift())
                                    @php($sURL = fDesktopURL($horoscTopContent->content_id, $horoscTopContent->category->cat_slug, ($horoscTopContent->subcategory->subcat_slug ?? null), $horoscTopContent->content_type))
                                    <h2 class="rakSab-common-cat-title"><a href="{{ url($horoscTopContent->category->cat_slug) }}">{{ $horoscTopContent->category->cat_name_bn }}</a></h2>
                                    <a href="{{ $sURL }}" class="link">
                                        <figure class="figure mb-0">
                                            @if($horoscTopContent->video_type == 1 && $horoscTopContent->video_id)
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $horoscTopContent->video_id }}/mqdefault.jpg" class="lazyload img-responsive w-100 mb-2" alt="{{ $horoscTopContent->content_heading }}">
                                            @else
                                                <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $horoscTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$horoscTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive w-100 mb-2" alt="{{ $horoscTopContent->content_heading }}" title="{{ $horoscTopContent->content_heading }}">
                                            @endif

                                            @if($horoscTopContent->video_id)
                                                <div class="video-icon">
                                                    <i class="fa fa-video-camera"></i>
                                                </div>
                                            @endif
                                        </figure>
                                        <h5 class="text-dark mt-2">{{ $horoscTopContent->content_heading }}</h5>
                                    </a>

                                    @php($horoscOtherContents = $horoscopeContents->all())

                                    @if($horoscOtherContents)
                                        <ul class="list-unstyled mb-5">
                                            @foreach($horoscOtherContents as $content)
                                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <li class="pt-2 pb-2 border-top "><a href="{{ $sURL }}" class="text-dark link">{{ $content->content_heading }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <a href="{{ url($horoscTopContent->category->cat_slug) }}" class="bg-light text-center py-2 text-theme more">আরও</a>
                                @endif
                            </div>
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