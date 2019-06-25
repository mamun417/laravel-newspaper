@extends('frontend.en.app')

@section('mainContent')
    <div class="main-content">
        <!-- Top Section -->
        <div class="pl-3 py-3 border-light border-bottom mb-3 bg-light">
            <div class="container">
                <ol class="list-unstyled list-inline m-0">
                    <li class="d-inline-block"><a href="{{ url('/en') }}" class="text-success"><i class="fa fa-home"></i></a></li> »
                    <li class="d-inline-block"><a href="{{ url('/en/'.$category->cat_slug) }}" class="text-success">{{ $category->cat_name }}</a></li>
                </ol>
            </div>
        </div>

        <div class="container py-2">
            <div class="row">
                <div class="col-sm-8">
                    @if($contents->count())
                        @php($topCatContent = $contents->shift())
                        @php($sURL = fEnURL($topCatContent->content_id, $topCatContent->category->cat_slug, ($topCatContent->subcategory->subcat_slug ?? null), $topCatContent->content_type))

                        <div class="mb-3 border-bottom">

                            <div class="row mx-n2 link">
                                <div class="col-sm-8 px-2">
                                    <div>
                                        <a href="{{ $sURL }}" class="text-dark">
                                            <figure class="figure mb-0">
                                                @if($topCatContent->video_type == 1 && $topCatContent->video_id)
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $topCatContent->video_id }}/hqdefault.jpg" class="lazyload img-responsive w-100" alt="{{ $topCatContent->content_heading }}">
                                                @else
                                                    <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $topCatContent->img_bg_path ? asset(config('appconfig.contentImagePath').$topCatContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"  class="lazyload img-responsive w-100" alt="{{ $topCatContent->content_heading }}" title="{{ $topCatContent->content_heading }}">
                                                @endif

                                                @if($topCatContent->video_id)
                                                    <div class="video-icon">
                                                        <i class="fa fa-video-camera"></i>
                                                    </div>
                                                @endif
                                            </figure>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-4 px-2">
                                    <h5 class="py-2 font-weight-bold">
                                        <a href="{{ $sURL }}" title="{{ $topCatContent->content_heading }}" class="text-dark">{{ $topCatContent->content_heading }}</a>
                                    </h5>
                                    <p>{{ fGetWord(fFormatString($topCatContent->content_details), 30) }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="list-unstyled row">
                                @if($contents)

                                    @foreach($contents as $content)

                                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                        <div class="col-sm-6 d-flex">
                                            <a href="{{ $sURL }}" class="media border-bottom mb-3 pb-3 text-dark w-100 link">
                                                <div class="w-50 mr-3">
                                                    <figure class="figure mb-0">
                                                        @if($content->video_type == 1 && $content->video_id)
                                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="lazyload img-responsive w-100" alt="{{ $content->content_heading }}">
                                                        @else
                                                            <img src="{{ asset(config('appconfig.lazyloaderPath')) }}" data-src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="lazyload img-responsive w-100" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                        @endif

                                                        @if($content->video_id)
                                                            <div class="video-icon">
                                                                <i class="fa fa-video-camera"></i>
                                                            </div>
                                                        @endif
                                                    </figure>
                                                </div>
                                                <div class="media-body">
                                                    {{ date('d F Y, h:i a', strtotime($content->created_at)) }}
                                                    <h6 class="pt-1 font-weight-bold mb-1">{{ $content->content_heading }}</h6>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <nav>
                                <ul class="pagination pagination-sm justify-content-center">
                                    {{ $contents->links()}}
                                </ul>

                            </nav>
                        </div>
                    @endif
                </div>
                <div class="col-sm-4">
                    <div class="shadow-sm mb-4 rounded-0 border-top">
                        @include('frontend.en.layouts.latestPopularBox')
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection