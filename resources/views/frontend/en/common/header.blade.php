
{{--<header>
    <div class="scrollmenu sidenav" id="mySidenav">
        <div class="container paddingTopBottom10 hidden-xs">
            <div class="row">
                <div class="col-sm-4">
                    <a href="{{ url('/en') }}" class="lg-logo">
                        <img src="{{ asset(config('appconfig.commonImagePath').'logo.png') }}" alt="Logo" style="width:270px;margin-left:-20px;">
                    </a>
                </div>
            </div>
        </div>

        <div id="stickyTopMenu">
            <div class="header-info">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 hidden-xs">
                            <small style="padding-top:8px;display: block;">
                                <i class="fa fa-map-marker"></i> Dhaka &nbsp;
                                <i class="fa fa-calendar"></i> {{ date('l, d F Y') }}
                            </small>
                        </div>
                        <div class="col-sm-4 text-center">

                        </div>
                        <div class="col-sm-2">
                            <form class="search_submit" action="" method="get" id="cse-search-box" role="search">
                                <input name="cx" value="" type="hidden">
                                <input name="cof" value="" type="hidden">
                                <input name="ie" value="utf-8" type="hidden">
                                <div class="input-group input-group-sm">
                                    <input class="form-control search_submit" placeholder="Search here..." name="q" id="q" type="text">
                                    <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" id="sa" name="sa" value=""><i class="fa fa-search"></i></button>
                            </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <span class="closebtn" onclick="closeNav('mySidenav')">&times;</span>
            <div class="menu_container">
                <div class="container">
                    <ul>
                        <li class="{{ !request()->segment(2) ? 'active' : '' }}"><a href="{{ url('/en') }}"><i class="fa fa-home"></i></a></li>
                        @php
                            $categories = enHeaderCategory();
                            //$topCategories = $categories->splice(0,13);
                        @endphp
                        @foreach($categories as $category)
                            <li class="{{ request()->segment(2) == $category->cat_slug ? 'active' : '' }}"><a href="{{ url('/en/'.$category->cat_slug) }}">{{ $category->cat_name }}</a></li>
                        @endforeach
                        <li><a href="{{ url('/en/archive') }}">Archive</a></li>
                    </ul>
                    <ul class="site_migrate hidden-xs">
                        <li><a href="{{ url('/') }}">বাংলা</a></li>
                    </ul>
                    <div class="all_category_btn hidden-xs">
                        <span onclick="open_mega_menu('all_category')"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; All </span>
                        <div class="all_category" id="all_category">
                            <div class="container">
                                <span class="caretd" onclick="close_mega_menu('all_category');">
                                    <i class="fa fa-close"></i>
                                </span>
                                <ul class="row">
                                    @foreach($categories as $category)
                                        <li class="col-sm-2"><a href="{{ url('/en/'.$category->cat_slug) }}">{{ $category->cat_name }}</a></li>
                                    @endforeach
                                    <li class="col-sm-2"><a href="{{ url('/en/archive') }}">Archive</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="logo-menu navbar-fixed-top visible-xs clearfix">
        <div class="container">
            <a href="{{ url('/en') }}" class="logo pull-left">
                <img src="{{ asset(config('appconfig.commonImagePath').'logo.png') }}" alt="Logo" style="width:140px;">
            </a>
            <div class="pull-right">
                <span class="openBtn" onclick="openNav('mySidenav')">&#9776;</span>
            </div>
            <div class="pull-right en_bn_link">
                <a href="{{ url('/') }}">বাংলা</a>
            </div>
        </div>
    </div>

    <div class="header-info hidden">
        <div class="container ">
            <div class="row">
                <div class="col-sm-4">
                    <small style="padding-top:8px;display: block;">{{ date('l, d F Y') }}</small>
                </div>
                <div class="col-sm-4 text-center">


                </div>
                <div class="col-sm-4">
                    <form class="search_submit" action="" method="get" id="cse-search-box" role="search">
                        <input name="cx" value="" type="hidden">
                        <input name="cof" value="" type="hidden">
                        <input name="ie" value="utf-8" type="hidden">
                        <div class="input-group input-group-sm">
                            <input class="form-control search_submit" placeholder="Search for..." name="q" id="q" type="text">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" id="sa" name="sa" value=""><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>--}}


<header class="w-100" id="header">
    <div class="bg-white w-100 py-2 d-sm-block d-none header-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ url('/en') }}" class="lg-logo">
                        <img src="{{ asset(config('appconfig.commonImagePath').'logo.png') }}" alt="Logo" class="logo">
                    </a>
                </div>
                <div>
                    <div>
                        <i class="fa fa-map-marker"></i> Dhaka &nbsp;
                        <i class="fa fa-calendar"></i> {{ date('l, d F Y') }}
                    </div>
                </div>
                <div>
                    <a href="" class="text-dark px-2" rel="nofollow" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="" class="text-dark px-2" rel="nofollow" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="" class="text-dark px-2" rel="nofollow" title="Youtube" target="_blank"><i class="fa fa-youtube"></i></a>
                    <a href="" class="text-dark px-2" rel="nofollow" title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i></a>
                    <a href="{{ url('/en/archive') }}" class="text-dark ml-5"><i class="fa fa-database"></i> Archive</a>
                    <a href="{{ url('/') }}" class="text-dark ml-5 btn btn-outline-success hover_cw"><i class="fa fa-language" aria-hidden="true"></i> বাংলা</a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" id="nav">
        <div class="container">
            <a class="navbar-brand d-sm-none d-block" href="{{ url('/en') }}">
                <img src="{{ asset(config('appconfig.commonImagePath').'logo.png') }}" alt="Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav m-mb-0">
                    <!--<li class="nav-item active"><a class="nav-link" href="#"><i class="fa fa-home"></i></a></li>-->
                    <li class="{{ !request()->segment(1) ? 'active' : '' }} nav-item"><a href="{{ url('/en') }}" class="nav-link"><i class="fa fa-home"></i></a></li>
                    @php
                        $categories = enHeaderCategory();
                        $topCategories = $categories->splice(0,12);
                    @endphp
                    @foreach($topCategories as $category)
                        <li class="{{ request()->segment(1) == $category->cat_slug ? 'active' : '' }} nav-item">
                            <a href="{{ url('/en/'.$category->cat_slug) }}" class="nav-link">{{ $category->cat_name }}</a>
                        </li>
                    @endforeach
                </ul>

                <ul class="navbar-nav m-border-0 m-mt-0 ml-auto m-pt-0">
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            All
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <div class="container">
                                <div class="row">
                                    @foreach($categories as $category)
                                        <a href="{{ url('/en/'.$category->cat_slug) }}" class="dropdown-item col-6 col-sm-2">{{ $category->cat_name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link dropdown-toggle search-toggler" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-search"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <div class="container">
                                <form action="" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light btn-outline-light" placeholder="Search for...">
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