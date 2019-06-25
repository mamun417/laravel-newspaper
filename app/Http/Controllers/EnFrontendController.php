<?php

namespace App\Http\Controllers;

use App\District;
use App\EnAuthor;
use App\EnCategory;
use App\EnComment;
use App\EnContent;
use App\EnContentPosition;
use App\EnSubcategory;
use App\Division;
use App\EnSurvey;
use App\PhotoAlbum;
use App\Upozilla;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnFrontendController extends Controller
{
    public function index(){
        // Special Top Contents
        $specialTopPosition = EnContentPosition::where('special_cat_id', 42)->where('deletable', 1)->first();
        if(!is_null($specialTopPosition->content_ids)){
            $aContentIDs = explode(",", $specialTopPosition->content_ids);
            $aContentIDs = array_slice($aContentIDs, 0, 9);
            $sContentIDs = implode(',', $aContentIDs);
            $specialTopContents = EnContent::with('category', 'subcategory')->whereIn('content_id', $aContentIDs)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $sContentIDs)")->get();
            //dd($specialTopContents);
        }

        $latestContents = EnHelperController::getLatestContent(10);
        $popularContents = EnHelperController::getPopularContent(10);

        $bnContents = BnHelperController::getLatestContent();

        // National Content
        $nationalContents = EnHelperController::getCategoryContent(1,5);

        // Politics Content
        $politicsContents = EnHelperController::getCategoryContent(2,5);

        // Economy Content
        $economyContents = EnHelperController::getCategoryContent(3, 5);

        // International Content
        $internationalContents = EnHelperController::getCategoryContent(4, 5);

        // Literature Content
        $literatureContents = EnHelperController::getCategoryContent(8, 5);

        // Sports Content 5
        $sportsContents = EnHelperController::getCategoryContent(5, 5);

        // Sports Content 6
        $sportsContentsNew = EnHelperController::getCategoryContent(5, 6);

        // Lifestyle Content
        $lifestyleContents = EnHelperController::getCategoryContent(9, 5);

        // Health Content
        $healthContents = EnHelperController::getCategoryContent(10, 5);

        // Technology Content
        $technologyContents = EnHelperController::getCategoryContent(7, 5);

        // Education Content
        $educationContents = EnHelperController::getCategoryContent(11, 5);

        // Career Content
        $careerContents = EnHelperController::getCategoryContent(12, 5);

        // Horoscope Content
        $horoscopeContents = EnHelperController::getCategoryContent(13, 5);

        // Entertainment Content
        $entertainmentContents = EnHelperController::getCategoryContent(6, 5);

        // Islam Content
        $islamContents = EnHelperController::getCategoryContent(17, 5);

        // Feature Content
        $featureContents = EnHelperController::getCategoryContent(20, 12);

        // Interview Content
        $interviewContents = EnHelperController::getCategoryContent(21, 5);

        // District Upozilla Content
        $disUpozContents = EnHelperController::getCategoryContent(16, 5);

        // Tourism Content
        $tourismContents = EnHelperController::getCategoryContent(15, 5);


        return view('frontend.en.home', compact('specialTopContents', 'latestContents', 'popularContents', 'bnContents', 'nationalContents', 'politicsContents', 'economyContents', 'internationalContents', 'literatureContents', 'lifestyleContents', 'sportsContents', 'sportsContentsNew', 'healthContents', 'technologyContents', 'educationContents', 'careerContents', 'horoscopeContents', 'entertainmentContents', 'islamContents', 'featureContents', 'interviewContents', 'disUpozContents', 'tourismContents'));
    }

    public function categoryContent($catSlug){
        $category = EnCategory::where('cat_slug', $catSlug)->where('status', 1)->where('deletable', 1)->first();
        if(is_null($category)){
            return abort(404);
        }

        $catId = $category->cat_id;

        $latestContents = EnHelperController::getLatestContent(10);
        $popularContents = EnHelperController::getPopularContent(10);

        $contents = EnHelperController::getCategoryContent($catId, 13, true);

        $otherCatContents = EnHelperController::getCategoryContent(rand(1,20), 5);

        return view("frontend.en.category", compact('category', 'contents', 'latestContents', 'popularContents', 'otherCatContents'));


    }

    public function subcategoryContent($cat, $subcat){

        $category = EnCategory::select('cat_id', 'cat_name', 'cat_slug', 'cat_title')->where('cat_slug', $cat)->where('status', 1)->where('deletable', 1)->first();

        if (is_null($category)) abort(404);

        $subcategory = EnSubcategory::select('subcat_id', 'cat_id', 'subcat_name', 'subcat_slug')->where('cat_id', $category->cat_id)->where('subcat_slug', $subcat)->where('status', 1)->where('deletable', 1)->first();

        if (is_null($subcategory)) abort(404);

        $latestCatContents = EnContent::with('category', 'subcategory')->where('cat_id', $category->cat_id)->where('subcat_id', $subcategory->subcat_id)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(15);

        $latestContents = EnHelperController::getLatestContent(5);
        $popularContents = EnHelperController::getPopularContent(5);

        return view('frontend.en.subcategory', compact('category', 'subcategory', 'latestCatContents', 'latestContents', 'popularContents'));

    }

    public function details($catSlug, $contentType, $contentId)
    {
        if (!is_numeric($contentId)) return abort(404);

        EnContent::where('content_id', $contentId)->increment('total_hit');
        $detailsContent = EnContent::with('category')->where('content_id', $contentId)->where('status', 1)->where('deletable', 1)->first();

        if (!$detailsContent) return abort(404);

        $author = EnAuthor::where('author_slug', $detailsContent->author_slugs)->where('deletable', 1)->first();

        $moreContents = EnContent::with('category', 'subcategory')->where('content_id', '<>', $contentId)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();

        $relatedContents = '';
        if ($detailsContent->related_ids){
            $aRelIds = explode(',', $detailsContent->related_ids);
            $relatedContents = EnContent::with('category', 'subcategory')->whereIn('content_id', $aRelIds)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $detailsContent->related_ids)")->get();
        }

        $latestContents = EnHelperController::getLatestContent(10);
        $popularContents = EnHelperController::getPopularContent(10);

        return view('frontend.en.details', compact('detailsContent', 'author', 'relatedContents', 'latestContents', 'popularContents', 'moreContents'));
    }

    public function archive(){
        $catId = trim(request()->cat);
        $dateFrom = trim(request()->dateFrom);
        $dateTo = trim(request()->dateTo);
        $keyword = trim(request()->keyword);

        $contents = EnContent::with('category', 'subcategory');

        if ($catId) $contents = $contents->where('cat_id', $catId);

        if ($dateFrom && $dateTo) $contents = $contents->whereBetween('created_at', [$dateFrom.' 00:00:00', $dateTo.' 23:59:59']);

//        if ($dateTo) $contents = $contents->where('created_at', 'like', $dateTo.'%');

        if ($keyword) $contents = $contents->where('content_heading', 'like', '%'.$keyword.'%');

        $contents = $contents->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(20);

        $categories = EnCategory::select('cat_id', 'cat_name')->where('deletable', 1)->where('status', 1)->get();

        $latestContents = EnHelperController::getLatestContent();
        $popularContents = EnHelperController::getPopularContent();
        return view('frontend.en.archive', compact('categories', 'contents', 'latestContents', 'popularContents', 'catId', 'dateFrom', 'dateTo', 'keyword'));
    }


    public function divisionDistrictUpozillaContent($divSlug, $distSlug=null, $upoSlug=null){

        $district = $upozilla = '';
        $contents = EnContent::with('category', 'subcategory', 'comments');
        if ($divSlug){
            $division = Division::select('division_id', 'division_name', 'division_slug')->where('division_slug', $divSlug)->where('deletable', 1)->first();
            if (is_null($division)) return abort(404);

            $contents = $contents->where('division_id', $division->division_id);
        }

        if ($distSlug){
            $district = District::select('district_id', 'district_name', 'district_slug')->where('district_slug', $distSlug)->where('deletable', 1)->first();
            if (is_null($district)) return abort(404);

            $contents = $contents->where('district_id', $district->district_id);
        }

        if ($upoSlug){
            $upozilla = Upozilla::select('upozilla_id', 'upozilla_name', 'upozilla_slug')->where('upozilla_slug', $upoSlug)->where('deletable', 1)->first();
            if (is_null($upozilla)) return abort(404);

            $contents = $contents->where('upozilla_id', $upozilla->upozilla_id);
        }

        $contents = $contents->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(21);

        $latestContents = EnHelperController::getLatestContent();
        $popularContents = EnHelperController::getPopularContent();

        return view('frontend.en.div-dis-upz', compact('contents', 'division', 'district', 'upozilla', 'latestContents', 'popularContents'));
    }

}

