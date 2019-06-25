<!DOCTYPE html>
<html lang="">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/assests/plugins/bootstrap-4.2.1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/assests/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/assests/common/css/soliman-lipi-font-face.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/assests/plugins/marquee/marquee.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/assests/common/css/style.css') }}">
    <title>@yield('title', 'USA BANGLA NEWS')</title>

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
<div id="overlay" onclick="overlay_click('overlay');"></div>
<button type="button" id="back_to_top">
    <i class="fa fa-angle-double-up" aria-hidden="true"></i>
</button>
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
    @include('frontend.en.common.header')

    @yield('mainContent')

    @include('frontend.en.common.footer')
</div>

<!-- Only for photo-gallery page -->
<script src="{{ asset('frontend-assets/plugins/lightbox-without-jquery/dist/lightbox-without-jquery.min.js') }}"></script>

<!-- Custom js -->
<script src="{{ asset('frontend-assets/common/js/all.js') }}"></script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('frontend-assets/assests/plugins/jquery/jquery-3.3.1.slim.min.js') }}"></script>
<script src="{{ asset('frontend-assets/assests/plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('frontend-assets/assests/plugins/bootstrap-4.2.1/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend-assets/assests/plugins/marquee/marquee.js') }}"></script>
<script src="{{ asset('frontend-assets/assests/common/js/custom.js') }}"></script>
<script>
    $('.marquee').marquee({
        pauseOnHover: true,
        duration: 30000
    });
</script>












<script src="{{ asset('frontend-assets/plugins/lazyload/lazyload.js') }}"></script>
<script src="{{ asset('frontend-assets/plugins/nav/nav.js') }}"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c97da3fc2f6b905"></script>

<!-- Only for photo-gallery page -->
<script src="{{ asset('frontend-assets/plugins/lightbox-without-jquery/dist/lightbox-without-jquery.min.js') }}"></script>

<!-- Custom js -->
<script src="{{ asset('frontend-assets/common/js/all.js') }}"></script>
</body>
</html>