@extends('frontend.en.app')

@section('mainContent')

    <div class="main-content">
        <div class="container">
            <!-- Top Section -->
            <p class="breadcrumb">
                <a href="{{ url('/en') }}"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="{{ url('/en/archive') }}" class="active">All News</a>
            </p>
            <div class="archive-search">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="custom-select">
                                <select name="cat">
                                    <option value="">-- Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->cat_id }}"{{ $category->cat_id == $catId ? ' selected' : '' }}>{{ $category->cat_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <script>
                                var x, i, j, selElmnt, a, b, c;
                                x = document.getElementsByClassName("custom-select");
                                for (i = 0; i < x.length; i++) {
                                    selElmnt = x[i].getElementsByTagName("select")[0];
                                    /*for each element, create a new DIV that will act as the selected item:*/
                                    a = document.createElement("DIV");
                                    a.setAttribute("class", "select-selected");
                                    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
                                    x[i].appendChild(a);
                                    /*for each element, create a new DIV that will contain the option list:*/
                                    b = document.createElement("DIV");
                                    b.setAttribute("class", "select-items select-hide");
                                    for (j = 1; j < selElmnt.length; j++) {
                                        /*for each option in the original select element,
                                         create a new DIV that will act as an option item:*/
                                        c = document.createElement("DIV");
                                        c.innerHTML = selElmnt.options[j].innerHTML;
                                        c.addEventListener("click", function(e) {
                                            /*when an item is clicked, update the original select box,
                                             and the selected item:*/
                                            var i, s, h;
                                            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                                            h = this.parentNode.previousSibling;
                                            for (i = 0; i < s.length; i++) {
                                                if (s.options[i].innerHTML == this.innerHTML) {
                                                    s.selectedIndex = i;
                                                    h.innerHTML = this.innerHTML;
                                                    break;
                                                }
                                            }
                                            h.click();
                                        });
                                        b.appendChild(c);
                                    }
                                    x[i].appendChild(b);
                                    a.addEventListener("click", function(e) {
                                        e.stopPropagation();
                                        closeAllSelect(this);
                                        this.nextSibling.classList.toggle("select-hide");
                                        this.classList.toggle("select-arrow-active");
                                    });
                                }
                                function closeAllSelect(elmnt) {
                                    var x, y, i, arrNo = [];
                                    x = document.getElementsByClassName("select-items");
                                    y = document.getElementsByClassName("select-selected");
                                    for (i = 0; i < y.length; i++) {
                                        if (elmnt == y[i]) {
                                            arrNo.push(i)
                                        } else {
                                            y[i].classList.remove("select-arrow-active");
                                        }
                                    }
                                    for (i = 0; i < x.length; i++) {
                                        if (arrNo.indexOf(i)) {
                                            x[i].classList.add("select-hide");
                                        }
                                    }
                                }
                                document.addEventListener("click", closeAllSelect);
                            </script>
                        </div>
                        <div class="col-sm-5">
                            <script src="{{ asset('frontend-assets/plugins/tiny-date-picker-master/dist/date-range-picker.min.js') }}"></script>
                            <div class="ex-inputs">
                                <div class="ex-inputs-header">
                                    <!--<input class="ex-inputs-start" placeholder="তারিখ " />
                                    থেকে
                                    <input class="ex-inputs-end" placeholder="পর্যন্ত " />-->
                                    <div class="input-group">
                                        <label for="dateFrom" class="input-group-addon ">Date  <i class="fa fa-calendar"></i></label>
                                        <input name="dateFrom" class="form-control ex-inputs-start" id="dateFrom" type="text" value="{{ $dateFrom or '' }}" placeholder="From">
                                        <label for="dateTo" class="input-group-addon">To  <i class="fa fa-calendar"></i></label>
                                        <input name="dateTo" class="form-control ex-inputs-end" id="dateTo" type="text" value="{{ $dateTo or '' }}" placeholder="To">
                                    </div>
                                </div>
                                <div class="ex-inputs-picker"></div>
                            </div>
                            <script>
                                (function () {
                                    const root = document.querySelector('.ex-inputs');
                                    const txtStart = root.querySelector('.ex-inputs-start');
                                    const txtEnd = root.querySelector('.ex-inputs-end');
                                    const container = root.querySelector('.ex-inputs-picker');

                                    // Inject DateRangePicker into our container
                                    DateRangePicker.DateRangePicker(container)
                                            .on('statechange', function (_, rp) {
                                                // Update the inputs when the state changes
                                                var range = rp.state;
                                                txtStart.value = range.start ? [range.start.getFullYear(), range.start.getMonth()+1, (range.start.getDate() < 10 ? '0' + range.start.getDate() : range.start.getDate())].join('-') : '';
                                                txtEnd.value = range.end ? [range.end.getFullYear(), range.end.getMonth()+1, (range.end.getDate() < 10 ? '0' + range.end.getDate() : range.end.getDate())].join('-') : '';
                                            });

                                    // When the inputs gain focus, show the date range picker
                                    txtStart.addEventListener('focus', showPicker);
                                    txtEnd.addEventListener('focus', showPicker);

                                    function showPicker() {
                                        container.classList.add('ex-inputs-picker-visible');
                                    }

                                    // If focus leaves the root element, it is not in the date
                                    // picker or the inputs, so we should hide the date picker
                                    // we do this in a setTimeout because redraws cause temporary
                                    // loss of focus.
                                    var previousTimeout;
                                    root.addEventListener('focusout', function hidePicker() {
                                        clearTimeout(previousTimeout);
                                        previousTimeout = setTimeout(function() {
                                            if (!root.contains(document.activeElement)) {
                                                container.classList.remove('ex-inputs-picker-visible');
                                            }
                                        }, 10);
                                    });

                                }());
                            </script>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group" style="margin-bottom:8px;">
                                <input type="text" name="keyword" value="{{ $keyword or '' }}" class="form-control" placeholder="Search here...">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <a href="{{ url('/en/archive') }}" class="btn btn-primary">All News</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="archive-box">

                        @foreach($contents as $content)

                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                            <div class="single-archive-item">
                                <div class="row">
                                    <div class="col-sm-3">
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

                                    <div class="col-sm-9">
                                        <small class="text-muted">
                                            <a href="{{ url($content->category->cat_slug) }}" class="jC_tag"> {{ $content->category->cat_name_bn }} </a> | <i class="fa fa-calendar"></i>
                                            {{ date('d F Y, h:i a, l', strtotime($content->created_at)) }}
                                        </small>
                                        <h3><a href="{{ $sURL }}" title="{{ $content->content_heading }}">{{ $content->content_heading }}</a></h3>
                                        <p class="hidden-xs text-muted">{{ $content->content_brief }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <hr>
                        {{ $contents->appends(['cat' => request('cat'), 'dateFrom' => request('dateFrom'), 'dateTo' => request('dateTo'), 'keyword' => request('keyword')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection