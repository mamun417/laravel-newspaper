<?php

namespace App\Http\Controllers;

use App\BnAuthor;
use App\BnCategory;
use App\BnComment;
use App\BnContent;
use App\BnContentPosition;
use App\BnSubcategory;
use App\BnSurvey;
use App\District;
use App\Division;
use App\EnContent;
use App\PhotoAlbum;
use App\Upozilla;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BnFrontendController extends Controller
{
    public function index(){
        // Special Top Contents
        $specialTopPosition = BnContentPosition::where('special_cat_id', 42)->where('deletable', 1)->first();
        if(!is_null($specialTopPosition->content_ids)){
            $aContentIDs = explode(",", $specialTopPosition->content_ids);
            $aContentIDs = array_slice($aContentIDs, 0, 9);
            $sContentIDs = implode(',', $aContentIDs);
            $specialTopContents = BnContent::with('category', 'subcategory')->whereIn('content_id', $aContentIDs)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $sContentIDs)")->get();
            //dd($specialTopContents);
        }

        $latestContents = BnHelperController::getLatestContent(10);
        $popularContents = BnHelperController::getPopularContent(10);

        $englishContents = EnHelperController::getLatestContent();

        // National Content
        $nationalContents = BnHelperController::getCategoryContent(1,5);

        // Politics Content
        $politicsContents = BnHelperController::getCategoryContent(2,5);

        // Economy Content
        $economyContents = BnHelperController::getCategoryContent(3, 5);

        // International Content
        $internationalContents = BnHelperController::getCategoryContent(4, 5);

        // Literature Content
        $literatureContents = BnHelperController::getCategoryContent(8, 5);

        // Sports Content
        $sportsContents = BnHelperController::getCategoryContent(5, 5);

        // Lifestyle Content
        $lifestyleContents = BnHelperController::getCategoryContent(9, 5);

        // Health Content
        $healthContents = BnHelperController::getCategoryContent(10, 5);

        // Technology Content
        $technologyContents = BnHelperController::getCategoryContent(7, 5);

        // Education Content
        $educationContents = BnHelperController::getCategoryContent(11, 5);

        // Career Content
        $careerContents = BnHelperController::getCategoryContent(12, 5);

        // Horoscope Content
        $horoscopeContents = BnHelperController::getCategoryContent(13, 5);

        // Entertainment Content
        $entertainmentContents = BnHelperController::getCategoryContent(6, 5);

        // Islam Content
        $islamContents = BnHelperController::getCategoryContent(17, 5);

        // Feature Content
        $featureContents = BnHelperController::getCategoryContent(20, 12);

        // Interview Content
        $interviewContents = BnHelperController::getCategoryContent(21, 5);

        // District Upozilla Content
        $disUpozContents = BnHelperController::getCategoryContent(16, 5);

        // Tourism Content
        $tourismContents = BnHelperController::getCategoryContent(15, 5);


        return view('frontend.bn.home', compact('specialTopContents', 'latestContents', 'popularContents', 'englishContents', 'nationalContents', 'politicsContents', 'economyContents', 'internationalContents', 'literatureContents', 'lifestyleContents', 'sportsContents', 'healthContents', 'technologyContents', 'educationContents', 'careerContents', 'horoscopeContents', 'entertainmentContents', 'islamContents', 'featureContents', 'interviewContents', 'disUpozContents', 'tourismContents'));
    }

    public function categoryContent($catSlug){
        $category = BnCategory::where('cat_slug', $catSlug)->where('status', 1)->where('deletable', 1)->first();
        if(is_null($category)){
            return abort(404);
        }

        $catId = $category->cat_id;

        $latestContents = BnHelperController::getLatestContent(10);
        $popularContents = BnHelperController::getPopularContent(10);

        $contents = BnHelperController::getCategoryContent($catId, 21, true);

        $otherCatContents = BnHelperController::getCategoryContent(rand(1,20), 5);

        return view("frontend.bn.category", compact('category', 'contents', 'latestContents', 'popularContents', 'otherCatContents'));


    }

    public function subcategoryContent($cat, $subcat){

        $category = BnCategory::select('cat_id', 'cat_name', 'cat_name_bn', 'cat_slug', 'cat_title')->where('cat_slug', $cat)->where('status', 1)->where('deletable', 1)->first();

        if (is_null($category)) abort(404);

        $subcategory = BnSubcategory::select('subcat_id', 'cat_id', 'subcat_name', 'subcat_name_bn', 'subcat_slug')->where('cat_id', $category->cat_id)->where('subcat_slug', $subcat)->where('status', 1)->where('deletable', 1)->first();

        if (is_null($subcategory)) abort(404);

        $latestCatContents = BnContent::with('category', 'subcategory')->where('cat_id', $category->cat_id)->where('subcat_id', $subcategory->subcat_id)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(15);

        $latestContents = BnHelperController::getLatestContent(5);
        $popularContents = BnHelperController::getPopularContent(5);

        return view('frontend.bn.subcategory', compact('category', 'subcategory', 'latestCatContents', 'latestContents', 'popularContents'));

    }

    public function details($catSlug, $contentType, $contentId)
    {
        if (!is_numeric($contentId)) return abort(404);

        $detailsContent = BnContent::with('category')->where('content_id', $contentId)->where('status', 1)->where('deletable', 1)->first();
        if (!$detailsContent) return abort(404);

        BnContent::where('content_id', $contentId)->increment('total_hit');
        $author = BnAuthor::where('author_slug', $detailsContent->author_slugs)->where('deletable', 1)->first();

        $moreContents = BnContent::with('category', 'subcategory')->where('content_id', '<>', $contentId)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();

        $relatedContents = '';
        if ($detailsContent->related_ids){
            $aRelIds = explode(',', $detailsContent->related_ids);
            $relatedContents = BnContent::with('category', 'subcategory')->whereIn('content_id', $aRelIds)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $detailsContent->related_ids)")->get();
        }

        $latestContents = BnHelperController::getLatestContent(10);
        $popularContents = BnHelperController::getPopularContent(10);

        return view('frontend.bn.details', compact('detailsContent', 'author', 'relatedContents', 'latestContents', 'popularContents', 'moreContents'));
    }

    public function archive(){
        $catId = trim(request()->cat);
        $dateFrom = trim(request()->dateFrom);
        $dateTo = trim(request()->dateTo);
        $keyword = trim(request()->keyword);

        $contents = BnContent::with('category', 'subcategory');

        if ($catId) $contents = $contents->where('cat_id', $catId);

        if ($dateFrom && $dateTo) $contents = $contents->whereBetween('created_at', [$dateFrom.' 00:00:00', $dateTo.' 23:59:59']);

//        if ($dateTo) $contents = $contents->where('created_at', 'like', $dateTo.'%');

        if ($keyword) $contents = $contents->where('content_heading', 'like', '%'.$keyword.'%');

        $contents = $contents->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(20);

        $categories = BnCategory::select('cat_id', 'cat_name', 'cat_name_bn')->where('deletable', 1)->where('status', 1)->get();

        $latestContents = BnHelperController::getLatestContent();
        $popularContents = BnHelperController::getPopularContent();
        return view('frontend.bn.archive', compact('categories', 'contents', 'latestContents', 'popularContents', 'catId', 'dateFrom', 'dateTo', 'keyword'));
    }

    public function generateSitemap(){
        $contents = BnHelperController::getLatestContent(200);

        $sData = '<?xml version="1.0" encoding="UTF-8"?>
                    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';

        foreach ($contents as $content){
            $sHeading=$content->content_heading;
            $sCategoryNameBN=strip_tags($content->category->cat_name_bn);
            $sURL=fDesktopURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type);
            //Date Time
            $timestamp=date('Y-m-d\TH:i:sP', strtotime($content->created_at));
            $sData .= "<url>
                            <loc>$sURL</loc>
                            <news:news>
                                <news:publication>
                                <news:name>ঢাকা প্রকাশ</news:name>
                                <news:language>bn</news:language>
                                </news:publication>
                                <news:publication_date>$timestamp</news:publication_date>
                                <news:title>$sHeading</news:title>
                                <news:keywords>$sCategoryNameBN</news:keywords>
                            </news:news>
                        </url>";
        }

        $sData .= '</urlset>';

        return response($sData)->header('Content-Type', 'text/xml');
    }

}

