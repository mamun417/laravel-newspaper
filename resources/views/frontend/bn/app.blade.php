<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ঢাকা প্রকাশ')</title>

    @yield('customMeta')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/plugins/bootstrap-3.3.7/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/nav/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/lazyload/lazyload.css') }}">

    <!-- only for archive page -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/tiny-date-picker-master/tiny-date-picker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/tiny-date-picker-master/date-range-picker.css') }}">

    <!-- Only for photo-gallery page -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/lightbox-without-jquery/dist/lightbox-without-jquery.min.css') }}">
    @yield('custom-css')
    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/style.css') }}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-139570021-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-139570021-1');
    </script>

</head>
<body onload="myFunction()">
<button type="button" id="back_to_top">
    <i class="fa fa-angle-double-up" aria-hidden="true"></i>
</button>
<div id="overlay" onclick="overlay_click('overlay');"></div>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div id="loader"></div>
<div id="wraper" class="animate-bottom">
    @include('frontend.bn.common.header')

    @yield('mainContent')

    @include('frontend.bn.common.footer')
</div>

<script src="{{ asset('frontend-assets/plugins/lazyload/lazyload.js') }}"></script>
<script src="{{ asset('frontend-assets/plugins/nav/nav.js') }}"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c97da3fc2f6b905"></script>

@yield('custom-js')

<!-- Only for photo-gallery page -->
<script src="{{ asset('frontend-assets/plugins/lightbox-without-jquery/dist/lightbox-without-jquery.min.js') }}"></script>

<!-- Custom js -->
<script src="{{ asset('frontend-assets/common/js/all.js') }}"></script>
</body>
</html>



