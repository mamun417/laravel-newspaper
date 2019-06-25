<div class="shadow-sm rounded-0 border-top mb-3 p-2">
    <ul class="nav nav-pills mb-3 border" id="pills-tab" role="tablist">
        <li class="flex-fill text-center nav-item">
            <a class="nav-link rounded-0 active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
               aria-controls="pills-home" aria-selected="true">Latest</a>
        </li>
        <li class="flex-fill text-center nav-item">
            <a class="nav-link rounded-0" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
               aria-controls="pills-profile" aria-selected="false">Popular </a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="list-unstyled list-unstyled-tab">

                @if($latestContents)
                    @foreach($latestContents as $content)
                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                        <a href="{{ $sURL }}" class="media mb-2 pb-2 border-bottom text-dark link">
                            <div class="w-50 mr-2">
                                <figure class="figure mb-0">

                                    @if($content->video_type == 1 && $content->video_id)
                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}"
                                             data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg"
                                             alt="{{ $content->content_heading }}" class="w-100">
                                    @else
                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}"
                                             data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"
                                             class="w-100" alt="{{ $content->content_heading }}"
                                             title="{{ $content->content_heading }}">
                                    @endif

                                </figure>
                            </div>
                            <div class="media-body">
                                <h6 class="font-weight-bold mb-1">{{ $content->content_heading }}</h6>
                            </div>
                        </a>

                    @endforeach
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="list-unstyled list-unstyled-tab">
                @if($popularContents)
                    @foreach($popularContents as $content)
                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                        <a href="{{ $sURL }}" class="media mb-2 pb-2 border-bottom text-dark link">
                            <div class="w-50 mr-2">
                                <figure class="figure mb-0">

                                    @if($content->video_type == 1 && $content->video_id)
                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}"
                                             data-src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg"
                                             alt="{{ $content->content_heading }}" class="w-100">
                                    @else
                                        <img src="{{ asset(config('appconfig.lazyloaderPath')) }}"
                                             data-src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"
                                             class="w-100" alt="{{ $content->content_heading }}"
                                             title="{{ $content->content_heading }}">
                                    @endif

                                </figure>
                            </div>
                            <div class="media-body">
                                <h6 class="font-weight-bold mb-1">{{ $content->content_heading }}</h6>
                            </div>
                        </a>

                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="text-center border-top py-2">
        <a href="" class="btn btn-outline-success">More News</a>
    </div>
</div>
