<footer>
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-sm-3">
                    <a href="{{ url('/') }}" class="footer-logo">
                        <img src="{{ asset(config('appconfig.commonImagePath').'logo-footer.png') }}" alt="Logo" title="Logo" class="img-responsive">
                    </a>
                </div>
                <div class="col-sm-9">
                    <ul class="row">
                        @php($categories = bnHeaderCategory())

                        @foreach($categories as $category)
                            <li class="col-sm-3 col-xs-6"><a href="{{ url($category->cat_slug) }}">{{ $category->cat_name_bn }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="address">
                        <p>১৯১/১, মালিবাগ, ঢাকা<br>
                            ফোন : 01682833187, ইমেইল: dhakaprokash2018@gmail.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p>© <?php echo date("Y");?> সর্বস্বত্ব সংরক্ষিত | <a href="">ঢাকা প্রকাশ</a>, উন্নয়নে: <a href="http://www.purpleit.com" target="_blank">Purple IT Ltd.</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>