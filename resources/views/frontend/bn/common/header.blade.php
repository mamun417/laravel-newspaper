<header class="w-100" id="header">
    <div class="bg-white w-100 py-2 d-sm-block d-none header-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ url('/') }}" class="lg-logo">
                        <img src="{{ asset(config('appconfig.commonImagePath').'logo.png') }}" alt="Logo" class="logo">
                    </a>
                </div>
                <div>
                    <div>
                        @php
                            $bn= new \App\Http\Controllers\BanglaDateController(time());
                            $bnDate=$bn->get_date();
                            $enDate = $bn->fFormatDate(date('l, d F Y'));
                        @endphp
                        <i class="fa fa-map-marker"></i> ঢাকা &nbsp;
                        <i class="fa fa-calendar"></i> {{ $enDate }} | {{ $bnDate[0]." ".$bnDate[1]." ".$bnDate[2] }}
                    </div>
                </div>
                <div>
                    <a href="" class="text-dark px-2" rel="nofollow" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="" class="text-dark px-2" rel="nofollow" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="" class="text-dark px-2" rel="nofollow" title="Youtube" target="_blank"><i class="fa fa-youtube"></i></a>
                    <a href="" class="text-dark px-2" rel="nofollow" title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i></a>
                    <a href="{{ url('/archive') }}" class="text-dark ml-5"><i class="fa fa-database"></i> আর্কাইভ</a>
                    <a href="{{ url('/en') }}" class="text-dark ml-5 btn btn-outline-success hover_cw"><i class="fa fa-language" aria-hidden="true"></i> English</a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" id="nav">
        <div class="container">
            <a class="navbar-brand d-sm-none d-block" href="{{ url('/') }}">
                <img src="{{ asset(config('appconfig.commonImagePath').'logo.png') }}" alt="Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav m-mb-0">
                    <!--<li class="nav-item active"><a class="nav-link" href="#"><i class="fa fa-home"></i></a></li>-->
                    <li class="{{ !request()->segment(1) ? 'active' : '' }} nav-item"><a href="{{ url('') }}" class="nav-link font-weight-bold"><i class="fa fa-home"></i></a></li>
                    @php
                        $categories = bnHeaderCategory();
                        $topCategories = $categories->splice(0,13);
                    @endphp
                    @foreach($topCategories as $category)
                        <li class="{{ request()->segment(1) == $category->cat_slug ? 'active' : '' }} nav-item">
                            <a href="{{ url('/'.$category->cat_slug) }}" class="nav-link font-weight-bold">{{ $category->cat_name_bn }}</a>
                        </li>
                    @endforeach

                </ul>
                <ul class="navbar-nav m-border-0 m-mt-0 ml-auto m-pt-0">
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link font-weight-bold dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            সকল
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <div class="container">
                                <div class="row">
                                @foreach($categories as $category)
                                        <a href="{{ url('/'.$category->cat_slug) }}" class="dropdown-item font-weight-bold col-6 col-sm-2">{{ $category->cat_name_bn }}</a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link font-weight-bold dropdown-toggle search-toggler" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-search"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <div class="container">
                                <form action="" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light btn-outline-light" placeholder="অনুসন্ধান করতে লিখুন...">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn text-white bg-secondary btn-outline-light"><i class="fa fa-search"></i> </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>