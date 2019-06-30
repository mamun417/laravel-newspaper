<!--Footer Add-->
<div class="container my-4 text-center">
    <img class="" src="https://tpc.googlesyndication.com/simgad/11193222596544275777">
</div>

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

                            @php($categories = bnHeaderCategory())

                            @foreach($categories as $category)
                                <a href="{{ url($category->cat_slug) }}" class="px-2 text-white">{{ $category->cat_name_bn }}</a>
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
                        <i class="fa fa-envelope"></i> সম্পাদক : জুবায়ের আহমদ রাজু, নির্বাহী সম্পাদক : খালেদ মিয়া, প্রকাশক : রুকন হাকিম
                    </div>
                    <div>
                        <i class="fa fa-map-marker"></i> Office : 3156 Bainbridge Ave, Bronx, NY 10467
                    </div>
                    <div>
                        <i class="fa fa-copyright"></i> <?php echo date("Y");?> সর্বস্বত্ব সংরক্ষিত | USA Bangla News, উন্নয়নে: <a class="text-white" href="http://www.purpleit.com" target="_blank">Purple IT Ltd.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>