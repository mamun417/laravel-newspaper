<div class="marquee-block">
    <h2>{{--সংবাদ --}}শিরোনাম </h2>
    <ul class="marquee">
        @php($breakingContents = \App\Http\Controllers\BnHelperController::getBreakingContent(10))
        @if($breakingContents)
            @foreach($breakingContents as $content)
                <li>
                    <a href="{{ fDesktopURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}"><i class="fa fa-globe"></i> {{ $content->content_heading }}</a>
                </li>
                @if(!$loop->last) | @endif
            @endforeach
        @endif
    </ul>
</div>

{{--
<div class="marquee-block">
    <h2>সংবাদ শিরোনাম </h2>
    <ul class="marquee">
        <li><a href=""><i class="fa fa-globe"></i> ট্রাস্ট ব্যাংকের সাড়ে ৮ কোটি টাকা আত্মসাৎ ভুয়া পে-অর্ডারে</a></li>
        <li><a href=""><i class="fa fa-globe"></i> সিঙ্গাপুরে যেভাবে সময় কাটাচ্ছেন ওবায়দুল কাদের</a></li>
        <li><a href=""><i class="fa fa-globe"></i> খালেদা জিয়ার মুক্তি আইনি প্রক্রিয়ায় না প্যারোলে?</a></li>
        <li><a href=""><i class="fa fa-globe"></i> এরশাদ সব সম্পত্তি ট্রাস্টে দান করলেন</a></li>
        <li><a href=""><i class="fa fa-globe"></i> ছেলেদের সাইড ব্যাগের উপকারীতা</a></li>
        <li><a href=""><i class="fa fa-globe"></i> যুক্তরাষ্ট্র মধ্যপ্রাচ্যে যুদ্ধে অগণিত শিশু মৃত্যুর জন্য দায়ী</a></li>
        <li><a href=""><i class="fa fa-globe"></i> ২২ বছর পর সেন্টমার্টিনে হঠাৎ বিজিবি মোতায়েন</a></li>
        <li><a href=""><i class="fa fa-globe"></i> স্বর্গীয় মুর্ছনায় সিডনিতে অনুষ্ঠিত হলো ইসলামী সাংস্কৃতিক সন্ধ্যা</a></li>
        <li><a href=""><i class="fa fa-globe"></i> থাইল্যান্ডের সাদম'র শিরোপা বিজয়ঃ বঙ্গবন্ধু কাপ গলফ দেশের গৌরব বৃদ্ধি করেছে- তথ্যমন্ত্রী</a></li>
        <li><a href=""><i class="fa fa-globe"></i> রান্নাঘরে শ্রাবন্তী, ছবি ভাইরাল</a></li>
    </ul>
</div>--}}
