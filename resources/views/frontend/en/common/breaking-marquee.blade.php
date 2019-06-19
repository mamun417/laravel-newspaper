<!-- Breking news marquee -->
<div class="breaking-marquee-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="marquee-wrap">
                    <div class="marquee-wrap">
                        <div class="marquee-heading text-center">
                            সদ্যপ্রাপ্ত:
                        </div>
                        <div class="marquee-text marquee">
                            <p>
                                @php($breakingContents = \App\Http\Controllers\BnHelperController::getBreakingContent())
                                @if($breakingContents)
                                    @foreach($breakingContents as $content)
                                        <a href="{{ fDesktopURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}">{{ $content->content_heading }}</a> @if(!$loop->last) | @endif
                                    @endforeach
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sports News -->
            <div class="col-md-12">
                <div class="marquee-wrap sport-scores">
                    <div class="marquee-wrap">
                        <div class="marquee-text marquee">
                            <p>Rising Stars 275/10 v Matabeleland Tuskers 4 *     Karachi Whites v Federally Administered Tribal Areas</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Homepage content start -->