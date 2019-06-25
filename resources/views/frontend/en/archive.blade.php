@extends('frontend.en.app')

@section('mainContent')

    <div class="main-content">

        <!-- Top Section -->
        <div class="pl-3 py-3 border-light border-bottom mb-3 bg-light">
            <div class="container">
                <ol class="list-unstyled list-inline m-0">
                    <li class="d-inline-block"><a href="{{ url('/en') }}" class="text-success"><i class="fa fa-home"></i></a></li>
                    »
                    <li class="d-inline-block">Archive </li>
                </ol>
            </div>
        </div>


        <div class="container py-2">
            <div class="row">
                <div class="col-sm-3">
                    <form action="" method="get" class="border border-light mb-4 shadow-sm p-4 rounded">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span id="" class="btn border border-right-0 rounded-left text-dark">Date </span>
                                </div>
                                <input type="date" placeholder="Search here..." class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="sr-only">Date</label>
                            <select name="cat" id="category" class="form-control">
                                <option value="">-- Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->cat_id }}"{{ $category->cat_id == $catId ? ' selected' : '' }}>{{ $category->cat_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="keyword" id="text_search" value="{{ $keyword or '' }}" placeholder="What are you looking for?" class="form-control">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-theme btn-block">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-9">
                    <div class="list-unstyled row">
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
                                        <small class="text-muted small" style="font-size:12px;">{{ date('d F Y, h:i a, l', strtotime($content->created_at)) }}</small>
                                        <h6 class="pt-1 font-weight-bold mb-1">{{ $content->content_heading }}</h6>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    <ul class="pagination pagination-sm">
                        {{ $contents->appends(['cat' => request()->cat, '' => request()->dateFrom, '' => request()->dateTo, 'keyword' => request()->keyword])->links()}}
                    </ul>
                </div>
            </div>
        </div>

    </div>


@endsection