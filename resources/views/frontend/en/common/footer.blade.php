<footer>
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-sm-3">
                    <a href="{{ url('/en') }}" class="footer-logo">
                        <img src="{{ asset(config('appconfig.commonImagePath').'logo-footer.png') }}" alt="Logo" title="Logo" class="img-responsive">
                    </a>
                </div>
                <div class="col-sm-9">
                    <ul class="row">
                        @php($categories = enHeaderCategory())

                        @foreach($categories as $category)
                            <li class="col-sm-3 col-xs-6"><a href="{{ url('/en/'.$category->cat_slug) }}">{{ $category->cat_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="address">
                        <p>191/1, Malibagh, Dhaka <br>
                            Phone : 01682833187, Email: dhakaprokash2018@gmail.com
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
                    <p>© <?php echo date("Y");?> All Right Reserved | <a href="{{ url('/') }}">Dhaka Prokash</a>, Developed by: <a href="http://www.purpleit.com" target="_blank">Purple IT Ltd.</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>