


<footer class="">
    <div class="pt-5 pb-2">
        <div class="container">
            <div class="finar">
                <div class="row">
                    <div class="col-sm-12 text-center mb-4">
                        <a href="" class="text-white px-2" rel="nofollow" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="" class="text-white px-2" rel="nofollow" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="" class="text-white px-2" rel="nofollow" title="Youtube" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="" class="text-white px-2" rel="nofollow" title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i></a>
                    </div>
                    <div class="d-none d-sm-block d-md-block d-lg-block d-xl-block">
                        <div class="col-sm-12 text-center mb-5 small">

                            @php($categories = enHeaderCategory())

                            @foreach($categories as $category)
                                <a href="{{ url('/en/'.$category->cat_slug) }}" class="px-2 text-white">{{ $category->cat_name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom py-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center small">
                    <div>
                        <i class="fa fa-envelope"></i> E-Mail : abcxyz@gmail.com,
                        <i class="fa fa-phone"></i> Mobile : 01711111111,
                        <i class="fa fa-map-marker"></i> Office : Dhaka
                    </div>
                    <div>
                        <i class="fa fa-copyright"></i> <?php echo date("Y");?> All Right Reserved | USA Bangla News, Developed by: <a class="text-success" href="http://www.purpleit.com" target="_blank">Purple IT Ltd.</a>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</footer>