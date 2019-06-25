<!-- Breking news marquee -->
<div class="marquee-block">
    <h2>Breaking News </h2>
    <ul class="marquee">
        @php($breakingContents = \App\Http\Controllers\EnHelperController::getBreakingContent(10))
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
<!-- Homepage content start -->




