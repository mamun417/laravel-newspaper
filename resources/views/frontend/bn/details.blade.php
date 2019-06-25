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



        <div class="container py-2 mb-4">
            <div class="row">
                <div class="col-sm-8">
                    <div>
                        <h2 class="font-weight-bold text-dark m-font-24">
                            ‘প্রথম শহীদ মিনারের রাষ্ট্রীয় স্বীকৃতি চাই’
                        </h2>
                        <p class="small text-muted">
                            <i class="fa fa-clock-o"></i> ২০ ডিসেম্বর ২০১৮, ০৮:৪২ পিএম |
                            আপডেট: ০৩ জানুয়ারি ২০১৯, ০২:২৪ পিএম
                        </p>
                    </div>
                    <figure class="figure">
                        <img src="https://s3-ap-southeast-1.amazonaws.com/images.jagonews24/media/imgAllNew/BG/2019January/rajshahi01-20190208155855.jpg" alt="Text" class="w-100">
                    </figure>

                    <div class="details">
                        <p>একাদশ জাতীয় সংসদ নির্বাচনের ফলাফল বাতিল করে অবিলম্বে নির্দলীয় সরকারের অধীনে নির্বাচনের দাবি
                            জানিয়ে নির্বাচন কমিশনে (ইসি) স্মারকলিপি দিয়েছ জাতীয় ঐক্যফ্রন্ট। ঐক্যফ্রন্টের মুখপাত্র
                            বিএনপির মহাসচিব মির্জা ফখরুল ইসলাম আলমগীরের নেতৃত্বে সাত সদস্যর একটি প্রতিনিধি দল আজ
                            বৃহস্পতিবার বিকেলে ইসিতে স্মারকলিপি জমা দেয়।</p>
                        <p>পরে মির্জা ফখরুল সাংবাদিকদের বলেন, ‘নির্বাচনের নামে জাতির সঙ্গে তামাশা করা হয়েছে। দেশকে
                            অন্ধকারের দিকে নিয়ে যাওয়া হয়েছে।’ ঐক্যফ্রন্টের জয়ীরা শপথ নেবেন কিনা—এমন প্রশ্নের জবাবে তিনি
                            বলেন, ‘আমরা ফলাফল প্রত্যাখ্যান করেছি। শপথ নেওয়ার প্রশ্ন আসবে কেন?’</p>
                        <p>এর আগে দুপুরে রাজধানীর গুলশানে বিএনপির মহাসচিব সাংবাদিকদের বলেন, একাদশ জাতীয় সংসদে যোগ দিচ্ছে
                            না বিএনপি ও জাতীয় ঐক্যফ্রন্ট। সাংবাদিকদের প্রশ্নের জবাবে তখন তিনি বলেন, ‘শপথ তো পার হয়ে
                            গেছে, শপথ নেব কোথায়? প্রত্যাখ্যান করলে আবার শপথ থাকে নাকি? আমরা শপথ নিচ্ছি না।’ তিনি অভিযোগ
                            করেন, নির্বাচনের নামে নিষ্ঠুর প্রতারণা ও প্রহসন করা হয়েছে। এ কারণে জাতীয় ঐক্যফ্রন্ট
                            নির্বাচনের ফল প্রত্যাখ্যান করে পুনর্নির্বাচনের দাবি জানাচ্ছে।</p>
                        <p>আজ সকালে একাদশ জাতীয় সংসদ নির্বাচনে নবনির্বাচিত সংসদ সদস্যদের শপথ গ্রহণ অনুষ্ঠিত হয়েছে। জাতীয়
                            সংসদ ভবনে অনুষ্ঠানে শুরুতে শপথ নেন স্পিকার শিরীন শারমিন চৌধুরী। অনুষ্ঠানে আওয়ামী লীগের সংসদ
                            সদস্যসহ প্রধানমন্ত্রী শেখ হাসিনা উপস্থিত ছিলেন। পরে সংসদ সদস্যদের শপথবাক্য পাঠ করান স্পিকার
                            শিরীন শারমিন চৌধুরী। শপথ নেওয়ার সময় আওয়ামী লীগ সভানেত্রী শেখ হাসিনার সঙ্গে ছিলেন আওয়ামী
                            লীগের জ্যেষ্ঠ নেতারা। এঁদের মধ্যে সাজেদা চৌধুরী, মতিয়া চৌধুরী, আমির হোসেন আমু, তোফায়েল আহমেদ
                            প্রমুখ ছিলেন। পরে সাংসদেরা শপথের কাগজে সই করেন।</p>
                        <p>আওয়ামী লীগের সদস্যরা শপথ নেওয়ার পর জাসদ, ওয়ার্কার্স পার্টি, তরিকত ফেডারেশন, জাতীয়
                            পার্টি-জেপির সদস্যরা শপথ নেন। এরপর জাতীয় পার্টির সদস্যরা শপথ নেন।</p>
                    </div>
                    <div class="border-top border-bottom py-3 my-2">
                        <i class="fa fa-tags text-success"></i>
                        <a href="" class="btn btn-sm btn-outline-success rounded-pill">আওয়ামী লীগ</a>
                        <a href="" class="btn btn-sm btn-outline-success rounded-pill">ফেডারেশন</a>
                        <a href="" class="btn btn-sm btn-outline-success rounded-pill">ঐক্যফ্রন্ট</a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="shadow-sm rounded mb-4 border-top">
                        <h6 class="font-weight-bold text-center bg-light m-0 p-3">এই বিভাগের আরো খবর </h6>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action link">যুক্তরাষ্ট্রে ২ হাজার কোটি ডলার
                                বিনিয়োগ করছে কাতার</a>
                            <a href="#" class="list-group-item list-group-item-action link">প্রেমিকের স্বপ্ন পূরণে বাবার কোটি
                                টাকা ডাকাতি করলেন প্রেমিকা</a>
                            <a href="#" class="list-group-item list-group-item-action link">যুক্তরাষ্ট্রে ২ হাজার কোটি ডলার
                                বিনিয়োগ করছে কাতার</a>
                            <a href="#" class="list-group-item list-group-item-action link">আরও ৫ বছর ক্ষমতায় থাকা একান্ত
                                প্রয়োজন : প্রধানমন্ত্রী</a>
                            <a href="#" class="list-group-item list-group-item-action link">প্রেমিকের স্বপ্ন পূরণে বাবার কোটি
                                টাকা ডাকাতি করলেন প্রেমিকা</a>
                        </div>
                        <div class="text-center p-3">
                            <a href="" class="btn btn-outline-secondary">সবখবর</a>
                        </div>
                    </div>
                    <div class="shadow-sm mb-4 rounded-0 border-top">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="flex-fill text-center nav-item">
                                <a class="nav-link rounded-0 active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">সর্বশেষ</a>
                            </li>
                            <li class="flex-fill text-center nav-item">
                                <a class="nav-link rounded-0" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">জনপ্রিয়</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action link">যুক্তরাষ্ট্রে ২ হাজার কোটি ডলার বিনিয়োগ করছে কাতার</a>
                                    <a href="#" class="list-group-item list-group-item-action link">প্রেমিকের স্বপ্ন পূরণে বাবার কোটি টাকা ডাকাতি করলেন প্রেমিকা</a>
                                    <a href="#" class="list-group-item list-group-item-action link">যুক্তরাষ্ট্রে ২ হাজার কোটি ডলার বিনিয়োগ করছে কাতার</a>
                                    <a href="#" class="list-group-item list-group-item-action link">আরও ৫ বছর ক্ষমতায় থাকা একান্ত প্রয়োজন : প্রধানমন্ত্রী</a>
                                    <a href="#" class="list-group-item list-group-item-action link">প্রেমিকের স্বপ্ন পূরণে বাবার কোটি টাকা ডাকাতি করলেন প্রেমিকা</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action link">যুক্তরাষ্ট্রে ২ হাজার কোটি ডলার বিনিয়োগ করছে কাতার</a>
                                    <a href="#" class="list-group-item list-group-item-action link">প্রেমিকের স্বপ্ন পূরণে বাবার কোটি টাকা ডাকাতি করলেন প্রেমিকা</a>
                                    <a href="#" class="list-group-item list-group-item-action link">যুক্তরাষ্ট্রে ২ হাজার কোটি ডলার বিনিয়োগ করছে কাতার</a>
                                    <a href="#" class="list-group-item list-group-item-action link">আরও ৫ বছর ক্ষমতায় থাকা একান্ত প্রয়োজন : প্রধানমন্ত্রী</a>
                                    <a href="#" class="list-group-item list-group-item-action link">প্রেমিকের স্বপ্ন পূরণে বাবার কোটি টাকা ডাকাতি করলেন প্রেমিকা</a>
                                </div>
                            </div>
                        </div>
                        <div class="text-center border-top py-2">
                            <a href="" class="btn btn-outline-success">সবখবর</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <h2 class="rakSab-common-cat-title"><span>আরও পড়ুন</span></h2>
                <div class="row">
                    <div class="col-sm-3 d-flex mb-3 col-6">
                        <a href="" class="d-block border-bottom border-success text-dark shadow-sm w-100 link">
                            <figure class="figure mb-0">
                                <img src="https://s3-ap-southeast-1.amazonaws.com/images.jagonews24/media/imgAllNew/SM/2019January/drink-poison-die-women-20190209142948.jpg" alt="Text" class="w-100 mb-2">
                            </figure>
                            <div class="px-3 py-2">
                                <h6 class="font-weight-bold">বউকে তুলে নেয়ার চেষ্টা : ছাত্রলীগ নেতাসহ গণধোলাইয়ের শিকার ২৫</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 d-flex mb-3 col-6">
                        <a href="" class="d-block border-bottom border-success text-dark shadow-sm w-100 link">
                            <figure class="figure mb-0">
                                <img src="https://s3-ap-southeast-1.amazonaws.com/images.jagonews24/media/imgAllNew/BG/2019January/noakhali01-20190208174435.jpg" alt="Text" class="w-100 mb-2">
                            </figure>
                            <div class="px-3 py-2">
                                <h6 class="font-weight-bold">‘বিগ বস’ ভাবিজি রাজনীতিতে</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 d-flex mb-3 col-6">
                        <a href="" class="d-block border-bottom border-success text-dark shadow-sm w-100 link">
                            <figure class="figure mb-0">
                                <img src="https://s3-ap-southeast-1.amazonaws.com/images.jagonews24/media/imgAllNew/SM/2019January/kumir-20190209174014.jpg" alt="Text" class="w-100 mb-2">
                            </figure>
                            <div class="px-3 py-2">
                                <h6 class="font-weight-bold">আমি তাদের সঙ্গে খুব মজা করে কাজ করেছি : মাধুরী</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 d-flex mb-3 col-6">
                        <a href="" class="d-block border-bottom border-success text-dark shadow-sm w-100 link">
                            <figure class="figure mb-0">
                                <img src="https://s3-ap-southeast-1.amazonaws.com/images.jagonews24/media/imgAllNew/SM/2019January/atok-ll-20190209220429.jpg" alt="Text" class="w-100 mb-2">
                            </figure>
                            <div class="px-3 py-2">
                                <h6 class="font-weight-bold">রাবি শিক্ষার্থীর মৃত্যু</h6>
                            </div>
                        </a>
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

@endsection
