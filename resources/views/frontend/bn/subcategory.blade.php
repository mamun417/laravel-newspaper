@extends('frontend.bn.app')

@section('title', $subcategory->subcat_name_bn . ' - বাংলাদেশ টাইমস')

@section('mainContent')
    <div class="container">
        <div class="row">
            <!-- site breadcrumb -->
            <div class="col-md-12">
                <div class="breadcrumb ">
                    <ul>
                        <li><a href="{{ url('/') }}"><strong >প্রচ্ছদ</strong></a></li>
                        <li><a href="{{ url('/' . $category->cat_slug) }}"><strong >{{ $category->cat_name_bn }}</strong></a></li>
                        <li><a href="{{ url('/' . $category->cat_slug . '/' . $subcategory->subcat_slug) }}"><strong >{{ $subcategory->subcat_name_bn }}</strong></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="category-all-section h-auto margin-top-30">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="greybg-area big-news-area">
                        <div class="section-hedding left-style-box">
                            <a href="#" class="link-overlay"></a>
                            <h2>{{ $subcategory->subcat_name_bn }}
                                <span></span>
                            </h2>
                        </div>

                        <!-- archive post type news -->
                        <div class="row">
                            @foreach($latestCatContents as $content)
                                <div class="col-md-4">
                                    <div class="category-post-news">
                                        <a href="{{ fDesktopURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}" class="link-overlay"></a>
                                        <div class="section-img">
                                            @if($content->video_type == 1 && $content->video_id)
                                                <img src="https://img.youtube.com/vi/{{ $content->video_id }}/hqdefault.jpg" alt="{{ $content->content_heading }}">
                                            @else
                                                <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" alt="{{ $content->content_heading }}">
                                            @endif

                                        </div>
                                        <div class="section-content">
                                            <h4 class="line-clamp line-clamp-2">{{ $content->content_heading }}</h4>
                                            <p class="post-date">
                                                {{ fFormatDateEn2Bn(date("d F Y", strtotime($content->created_at))) }}
                                                <span>/</span> {{ fFormatDateEn2Bn($content->comments->count()) }}টি মন্তব্য
                                            </p>
                                            <p class="line-clamp line-clamp-4">{{ $content->content_brief }}</p>
                                            <span class="more-post">
                                            <a href="#">বিস্তারিত</a>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                @if($loop->iteration == 6)
                                    <div class="gallery-single-ad">
                                        <img src="{{ asset(config('appconfig.contentImagePath').'2017November/gallery-ad-1.jpg') }}" alt="">
                                    </div>
                                @elseif($loop->iteration == 12)
                                <!-- category dual ad -->
                                    <div class="gallery-single-ad">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="ad-container h-240">
                                                    <img src="{{ asset(config('appconfig.contentImagePath').'2017November/meri-ad.png') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="ad-container h-240">
                                                    <img src="{{ asset(config('appconfig.contentImagePath').'2017November/mojo-ad.jpg') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($loop->count > 3 && $loop->iteration % 3 == 0)</div><div class="row">  @endif
                            @endforeach
                        </div>

                    </div>

                    <div class="more-replay margin-top-45">
                        {{ $latestCatContents->links('vendor.pagination.bn-default') }}
                    </div>
                </div><!-- col md 8 end -->


                <div class="col-md-4">
                    <div class="gallery-slide-ad main-silde-area-ad margin-bottom-25">
                        <a href="#">
                            <img src="{{ asset(config('appconfig.contentImagePath').'2017November/main-slide-ad-1.jpg') }}" alt="">
                        </a>
                    </div>

                    <!-- facebook widget -->
                @include('frontend.bn.layouts.facebook-likebox')


                <!-- tab section -->
                    <div class="greybg-area people-que-area margin-top-25">
                        <div class="custom-tab readers-qs">
                            @include('frontend.bn.layouts.latestPopularBox')
                        </div>
                    </div><!--/. tab section end -->


                    <!-- side ad -->
                    <div class="ad-container h-240 margin-top-25">
                        <img src="{{ asset(config('appconfig.contentImagePath').'2017November/meri-ad.png') }}" alt="">
                    </div>

                    <!-- calander -->
                    @include('frontend.bn.layouts.archive-calendar')

                </div><!--/. col-md-4 end -->
            </div><!--/. row end -->
        </div>
    </div>

@endsection