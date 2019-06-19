<?php

namespace App\Http\Controllers;

use App\EnContent;
use App\EnSubcategory;
use App\District;
use App\EnSurvey;
use App\PhotoAlbum;
use App\Upozilla;
use App\Video;
use Illuminate\Http\Request;

class EnHelperController extends Controller
{
    public static function getBreakingContent($limit=5){
        // Get breaking content
        $breakingContents = EnContent::with('category', 'subcategory')->where('scroll', 2)->where('status', 1)->where('deletable', 1)->take($limit)->get();
        return $breakingContents;
    }
    public static function getCategoryContent($catId, $limit, $paginate=false){
        $contents = EnContent::with('category', 'subcategory')->where('cat_id', $catId)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');

        if($paginate){
            $contents = $contents->paginate($limit);
        }else{
            $contents = $contents->take($limit)->get();
        }

        return $contents;
    }

    public static function getSubcatContent($subcatSlug, $limit=5, $paginate=false){
        $subcat = EnSubcategory::where('subcat_slug', $subcatSlug)->where('deletable', 1)->first();
        $subcatId = $subcat->subcat_id;
        $contents = EnContent::with('category', 'subcategory')->where('subcat_id', $subcatId)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');

        if($paginate){
            $contents = $contents->paginate($limit);
        }else{
            $contents = $contents->take($limit)->get();
        }

        return $contents;
    }

    public static function getLatestContent($limit=5, $paginate=false, $comment = false){
        $contents = EnContent::with('category', 'subcategory')->orderBy('content_id', 'desc');
        if($comment){
            $contents = $contents->with('comments');
        }

        $contents = $contents->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');


        if($paginate){
            $contents = $contents->paginate($limit);
        }else{
            $contents = $contents->take($limit)->get();
        }
        return $contents;
    }

    public static function getPopularContent($limit=5){
        $contents = EnContent::with('category', 'subcategory')->where('status', 1)->where('deletable', 1)->orderBy('total_hit', 'desc')->take($limit)->get();
        return $contents;
    }

    public static function getLatestCatContent($catId, $limit=5, $skip=null){
        $contents = EnContent::with('category', 'subcategory')->where('cat_id', $catId)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');
        if ($skip){
            $contents = $contents->skip($skip);
        }

        $contents = $contents->take($limit)->get();
        return $contents;
    }

    public function districtPopulate(Request $request){
        $districts = District::where('division_id', $request->division_id)->where('deletable', 1)->get();
        return $districts;
    }

    public function upozillaPopulate(Request $request){
        $upozillas = Upozilla::where('district_id', $request->district_id)->where('deletable', 1)->get();
        return $upozillas;
    }

    public static function getLatestAlbum($limit=5){
        $albums = PhotoAlbum::with('category', 'subcategory', 'gallery')->where('deletable', 1)->orderBy('album_id', 'desc')->take($limit)->get();
        return $albums;
    }

    public static function getLatestVideo($limit=5){
        $videos = Video::with('category', 'subcategory')->where('deletable', 1)->orderBy('video_id', 'desc')->take($limit)->get();
        return $videos;
    }

    public static function getCatwiseVideo($catId, $limit=5){
        $videos = Video::with('category', 'subcategory')->where('cat_id', $catId)->where('deletable', 1)->orderBy('video_id', 'desc')->take($limit)->get();
        return $videos;
    }

    public static function getPopularVideo($limit=5){
        $videos = Video::with('category', 'subcategory')->where('deletable', 1)->orderBy('total_hit', 'desc')->take($limit)->get();
        return $videos;
    }

    public static function getEnSurvey($limit, $paginate=false){
        if ($limit == 1){
            $survey = EnSurvey::where('status', 2)->where('deletable', 1)->orderBy('survey_id', 'desc')->first();
        }else{
            $survey = EnSurvey::where('status', 2)->where('deletable', 1)->orderBy('survey_id', 'desc');
            if ($paginate){
                $survey = $survey->paginate($limit);
            }else{
                $survey = $survey->take($limit)->get();
            }
        }

        return $survey;

    }

}
