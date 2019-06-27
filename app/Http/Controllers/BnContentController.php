<?php

namespace App\Http\Controllers;

use App\BnAuthor;
use App\BnCategory;
use App\BnContent;
use App\BnContentPosition;
use App\BnSubcategory;
use App\BnTag;
use App\Country;
use App\District;
use App\MisUser;
use Illuminate\Http\Request;

class BnContentController extends Controller
{
    public function populateCat(Request $request){
        if ($request->cat_id == 1 || $request->cat_id == 2){
            $categories = BnCategory::select('cat_id as id', 'cat_name_bn as name')->where('cat_type', $request->cat_id)->where('status', 1)->where('deletable', 1)->get();
        }elseif ($request->cat_id == 3){
            $categories = BnSubcategory::select('subcat_id as id', 'subcat_name_bn as name')->where('deletable', 1)->get();
        }
        return $categories;
    }

    public function index(Request $request)
    {
        // Get search field values for pagination
        $exPartPagination = ["catType" => $request->catType, "catId" => $request->catId, "dateRange" => $request->dateRange, "searchBy" => $request->searchBy, "keyword" => $request->keyword];

        $contents = BnContent::with('category', 'specialCategory', 'subCategory');
        if ($request->catType == 1){ // Search content with category
            $contents = $contents->where('cat_id', $request->catId);
        }elseif ($request->catType == 2){ // Search content with Special category
            $contents = $contents->where('special_cat_id', $request->catId);
        }elseif ($request->catType == 3){ // Search content with Subcategory
            $contents = $contents->where('subcat_id', $request->catId);
        }

        if ($request->searchBy == 1){ // Search content with ID
            $contents = $contents->where('content_id', trim($request->keyword));
        }elseif ($request->searchBy == 2){ // Search content with Heading
            $contents = $contents->where('content_heading', 'like', '%'.trim($request->keyword).'%');
        }elseif ($request->searchBy == 3){ // Search content with Writer
            $writer = BnAuthor::where('author_name_bn', 'like', trim($request->keyword).'%')->first();
            //return $writer->author_id;
            if ($writer->author_id){
                $contents = $contents->where('author_slugs', 'like', '%'.$writer->author_id.'%');
            }
        }
        $contents = $contents->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(20);

        $categories = BnCategory::where('cat_type', 1)->where('deletable', 1)->get();
        $specialCategories = BnCategory::where('cat_type', 2)->where('deletable', 1)->get();
        $districts = District::where('deletable', 1)->orderBy('district_name')->get();

        return view('backend.bn.content.content_list', compact('contents', 'categories', 'specialCategories', 'districts', 'exPartPagination'));
    }

    public function create()
    {
        $authors = BnAuthor::where('deletable', 1)->get();
        $categories = BnCategory::where('cat_type', 1)->where('status', 1)->where('deletable', 1)->get();
        $specialCategories = BnCategory::where('cat_type', 2)->where('deletable', 1)->get();
        $countries = Country::where('deletable', 1)->orderBy('country_name')->get();
        $districts = District::where('deletable', 1)->orderBy('district_name')->get();
        $mis_uploaders = MisUser::where('user_type', 3)->where('deletable', 1)->get();


        //return $categories;

        return view('backend.bn.content.content_create', compact('authors', 'categories', 'specialCategories', 'countries', 'districts', 'mis_uploaders'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'newsHeading' => 'required',
//            'smallImage' => 'mimes:jpeg,jpg,png,gif|dimensions:width=320,height=180|max:40',
            'detailsNews' => 'required',
            'largeImage' => 'mimes:jpeg,jpg,png,gif|dimensions:width=750,height=390|max:100',
//            'exSmallImage' => 'mimes:jpeg,jpg,png,gif|dimensions:width=120,height=80|max:10',
        ]);


        $content = new BnContent();
        $content->content_heading = $request->newsHeading;
        $content->content_sub_heading = $request->newsSubheading;
        $content->author_slugs = $request->writer;
        $content->content_brief = $request->briefNews;
        $content->content_details = $request->detailsNews;

//        if ($request->smallImage) { // SM Image
//            if ($request->hasFile('smallImage')) { // upload SM normal image
//                $finalImageSMPath = FileController::fileUpload($request->smallImage, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder . 'SM/');
//            }
//            $content->img_sm_path = $finalImageSMPath;
//            $content->img_sm_caption = $request->ImageSMCaption;
//
//        } elseif ($request->ImageSMPath) {
//            $isArchiveSM = explode(':', $request->ImageSMPath); // SM image upload, crop and archive
//            if ($isArchiveSM[0] == "http") {
//                //archives --- cut imgAll/ and get all after
//                $finalImageSMPath = substr($request->ImageSMPath, strpos($request->ImageSMPath, 'images') + 7);
//
//            } elseif ($isArchiveSM[0] == "data" && isset($request->ImageSMLocalName)) { // upload SM cropped image
//                $imgLocalName = $request->ImageSMLocalName;
//
//                $finalImageSMPath = FileController::base64ToJpeg($request->ImageSMPath, $imgLocalName, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder . 'SM/');
//                //return $finalImageSMPath;
//
//
//            } // end of SM image upload, crop and archive section
//            $content->img_sm_path = $finalImageSMPath;
//            $content->img_sm_caption = $request->ImageSMCaption;
//        }

        if ($request->largeImage) { // BG Image
            if ($request->hasFile('largeImage')) { // upload SM normal image
                $finalImageBGPath = FileController::imageIntervention($request->largeImage,config('appconfig.contentImagePath'),750,390);

                // SM Image upload
                $finalImageSMPath = FileController::imageIntervention($request->largeImage, config('appconfig.contentImagePath'), 320, 180, 'SM/');

                // XS Image upload
                $finalImageXSPath = FileController::imageIntervention($request->largeImage, config('appconfig.contentImagePath'), 320, 180, 'XS/');
            }
            // BG Image path
            $content->img_bg_path = $finalImageBGPath;
            $content->img_bg_caption = $request->ImageBGCaption;

            // SM Image path
            $content->img_sm_path = $finalImageSMPath;
//            $content->img_sm_caption = $request->ImageSMCaption;

            // XS Image path
            $content->img_xs_path = $finalImageXSPath;
        }

//        if ($request->largeImage) { // BG Image
//            if ($request->hasFile('largeImage')) { // upload SM normal image
//                $finalImageBGPath = FileController::fileUpload($request->largeImage, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder);
//            }
//            //return $request->ImageBGCaption;
//            $content->img_bg_path = $finalImageBGPath;
//            $content->img_bg_caption = $request->ImageBGCaption;
//
//        } elseif ($request->ImageBGPath) {
//            $isArchiveBG = explode(':', $request->ImageBGPath); // BG image upload, crop and archive
//            if ($isArchiveBG[0] == "http") {
//                //archives --- cut imgAll/ and get all after
//                $finalImageBGPath = substr($request->ImageBGPath, strpos($request->ImageBGPath, 'images') + 7);
//
//            } elseif ($isArchiveBG[0] == "data" && isset($request->ImageBGLocalName)) { // upload SM cropped image
//                $imgLocalName = $request->ImageBGLocalName;
//
//                $finalImageBGPath = FileController::base64ToJpeg($request->ImageBGPath, $imgLocalName, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder);
//
//
//            } // end of SM image upload, crop and archive section
//            //return $finalImageBGPath;
//            $content->img_bg_path = $finalImageBGPath;
//            $content->img_bg_caption = $request->ImageBGCaption;
//        }

//        if ($request->exSmallImage) { // Extra Small Image
//            if ($request->hasFile('exSmallImage')) { // upload SM normal image
//                $finalImageExSMPath = FileController::fileUpload($request->exSmallImage, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder . 'EXSM/');
//            }
//            //return $request->ImageBGCaption;
//            $content->img_xs_path = $finalImageExSMPath;
//
//        } elseif ($request->ImageExSMPath) {
//            $isArchiveExSM = explode(':', $request->ImageExSMPath); // BG image upload, crop and archive
//            if ($isArchiveExSM[0] == "http") {
//                //archives --- cut imgAll/ and get all after
//                $finalImageExSMPath = substr($request->ImageExSMPath, strpos($request->ImageExSMPath, 'images') + 7);
//
//            }// end of SM image upload, crop and archive section
//            //return $finalImageExSMPath;
//            $content->img_xs_path = $finalImageExSMPath;
//        }

        $content->content_type = $request->contentType;
        $content->cat_id = $request->category;
        $content->subcat_id = $request->subCategory;
        $content->special_cat_id = $request->specialCategory;
        $content->country_id = $request->country;
        $content->district_id = $request->district;
        if ($request->district){
            $content->division_id   = District::find($request->district)->division_id;
        }
        $content->upozilla_id = $request->upozilla;
        $content->uploader_id = $request->uploader;
        if ($request->prevNewsIds) $content->related_ids = implode(',', $request->prevNewsIds);
        if ($request->photoGalaryIds) $content->photo_ids = implode(',', $request->photoGalaryIds);
        $content->video_type = $request->videoType;
        $content->video_id = $request->videoId;
        $content->tags = $request->normalTags;
        $content->scroll = $request->scroll;

        $content->save();

        // Insert news position
        if ($request->category && $request->categoryPosition) {
            $type = 'cat';
            $this->setNewsPosition($type, $request->category, $request->categoryPosition, $content->content_id);
        }

        // Insert Lead News Position
        if ($request->leadNews == 1){
            $news_id = $content->content_id;
            $content_ids = BnContentPosition::select('content_ids')->first();
            $content_ids = $news_id.','.$content_ids->content_ids;
            $content_ids_array = explode(',', $content_ids);
            $new_content_ids = array_slice($content_ids_array, 0, 6);
            BnContentPosition::where('position_id', 1)->update(['content_ids' => implode(',',$new_content_ids)]);
        }


        // Generate HTML
        //new GenerateHTMLController($request->category, $request->specialCategory, $request->subCategory);
//        if ($request->specialCategory && $request->specialCategoryPosition) {
//            $type = 'special_cat';
//            $this->setNewsPosition($type, $request->specialCategory, $request->specialCategoryPosition, $content->content_id);
//        }
//        if ($request->subCategory && $request->subCategoryPosition) {
//            $type = 'subcat';
//            $this->setNewsPosition($type, $request->subCategory, $request->subCategoryPosition, $content->content_id);
//        }

        return redirect('backend/bn-contents')->with('successMsg', 'The content has been submitted successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $content = BnContent::find($id);
        $authors = BnAuthor::where('deletable', 1)->get();
        $categories = BnCategory::where('cat_type', 1)->where('status', 1)->where('deletable', 1)->get();
        $specialCategories = BnCategory::where('cat_type', 2)->where('deletable', 1)->get();
        $countries = Country::where('deletable', 1)->get();
        $districts = District::where('deletable', 1)->get();
        $mis_uploaders = MisUser::where('user_type', 3)->where('deletable', 1)->get();

        $normaltag_list = [];

        if ($content->tags) {
            $normal_tags = explode(',', $content->tags);
            foreach ($normal_tags as $normal_tag) {
                $normaltag = BnTag::select('tag_name', 'tag_slug')->where('tag_slug', $normal_tag)->first();
                if ($normaltag) $normaltag_list[] = ['id' => $normaltag->tag_slug, 'name' => $normaltag->tag_name];
            }
        }

        $peopletag_list = [];

        if ($content->people_tags) {
            $people_tags = explode(',', $content->people_tags);

            foreach ($people_tags as $people_tag) {
                $peopletag = BnTag::select('tag_name', 'tag_slug')->where('tag_slug', $people_tag)->first();
                if ($peopletag) $peopletag_list[] = ['id' => $peopletag->tag_slug, 'name' => $peopletag->tag_name];
            }
        }


        $placetag_list = [];

        if ($content->place_tags) {
            $place_tags = explode(',', $content->place_tags);

            foreach ($place_tags as $place_tag) {
                $placetag = BnTag::select('tag_name', 'tag_slug')->where('tag_slug', $place_tag)->first();
                if ($placetag) $placetag_list[] = ['id' => $placetag->tag_slug, 'name' => $placetag->tag_name];
            }
        }
        //return $categories;
        //dd($content->toArray());

        return view('backend.bn.content.content_edit', compact('content', 'authors', 'categories', 'specialCategories', 'countries', 'districts', 'mis_uploaders', 'normaltag_list', 'peopletag_list', 'placetag_list'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'newsHeading' => 'required',
//            'smallImage' => 'mimes:jpeg,jpg,png,gif|dimensions:width=320,height=180|max:40',
            'largeImage' => 'mimes:jpeg,jpg,png,gif|dimensions:width=750,height=390|max:100',
            'detailsNews' => 'required',
//            'exSmallImage' => 'mimes:jpeg,jpg,png,gif|dimensions:width=120,height=80|max:10',
        ]);


        $content = BnContent::find($id);
        $content->content_heading = $request->newsHeading;
        $content->content_sub_heading = $request->newsSubheading;
        $content->author_slugs = $request->writer;
        $content->content_brief = $request->briefNews;
        $content->content_details = $request->detailsNews;

        if ($request->largeImage) { // BG Image
            if ($request->hasFile('largeImage')) { // upload SM normal image
                $finalImageBGPath = FileController::imageIntervention($request->largeImage,config('appconfig.contentImagePath'),750,390);

                // SM Image upload
                $finalImageSMPath = FileController::imageIntervention($request->largeImage, config('appconfig.contentImagePath'), 320, 180, 'SM/');

                // XS Image upload
                $finalImageXSPath = FileController::imageIntervention($request->largeImage, config('appconfig.contentImagePath'), 320, 180, 'XS/');
            }
            // BG Image path
            $content->img_bg_path = $finalImageBGPath;

            // SM Image path
            $content->img_sm_path = $finalImageSMPath;
//            $content->img_sm_caption = $request->ImageSMCaption;

            // XS Image path
            $content->img_xs_path = $finalImageXSPath;
        }
        $content->img_bg_caption = $request->ImageBGCaption;
//        if ($request->smallImage) { // SM Image
//            if ($request->hasFile('smallImage')) { // upload SM normal image
//                $finalImageSMPath = FileController::fileUpload($request->smallImage, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder . 'SM/');
//            }
//            $content->img_sm_path = $finalImageSMPath;
//            $content->img_sm_caption = $request->ImageSMCaption;
//
//        } elseif ($request->ImageSMPath) {
//            $isArchiveSM = explode(':', $request->ImageSMPath); // SM image upload, crop and archive
//            if ($isArchiveSM[0] == "http") {
//                //archives --- cut imgAll/ and get all after
//                $finalImageSMPath = substr($request->ImageSMPath, strpos($request->ImageSMPath, 'images') + 7);
//
//            } elseif ($isArchiveSM[0] == "data" && isset($request->ImageSMLocalName)) { // upload SM cropped image
//                $imgLocalName = $request->ImageSMLocalName;
//
//                $finalImageSMPath = FileController::base64ToJpeg($request->ImageSMPath, $imgLocalName, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder . 'SM/');
//                //return $finalImageSMPath;
//
//
//            } // end of SM image upload, crop and archive section
//            $content->img_sm_path = $finalImageSMPath;
//
//        }
//        $content->img_sm_caption = $request->ImageSMCaption;
//
//
//        if ($request->largeImage) { // BG Image
//            if ($request->hasFile('largeImage')) { // upload SM normal image
//                $finalImageBGPath = FileController::fileUpload($request->largeImage, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder);
//            }
//            //return $request->ImageBGCaption;
//            $content->img_bg_path = $finalImageBGPath;
//            $content->img_bg_caption = $request->ImageBGCaption;
//
//        } elseif ($request->ImageBGPath) {
//            $isArchiveBG = explode(':', $request->ImageBGPath); // BG image upload, crop and archive
//            if ($isArchiveBG[0] == "http") {
//                //archives --- cut imgAll/ and get all after
//                $finalImageBGPath = substr($request->ImageBGPath, strpos($request->ImageBGPath, 'images') + 7);
//
//            } elseif ($isArchiveBG[0] == "data" && isset($request->ImageBGLocalName)) { // upload SM cropped image
//                $imgLocalName = $request->ImageBGLocalName;
//
//                $finalImageBGPath = FileController::base64ToJpeg($request->ImageBGPath, $imgLocalName, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder);
//
//
//            } // end of SM image upload, crop and archive section
//            //return $finalImageBGPath;
//            $content->img_bg_path = $finalImageBGPath;
//
//        }
//        $content->img_bg_caption = $request->ImageBGCaption;
//
//        if ($request->exSmallImage) { // Extra Small Image
//            if ($request->hasFile('exSmallImage')) { // upload SM normal image
//                $finalImageExSMPath = FileController::fileUpload($request->exSmallImage, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder . 'EXSM/');
//            }
//            //return $request->ImageBGCaption;
//            $content->img_xs_path = $finalImageExSMPath;
//
//        } elseif ($request->ImageExSMPath) {
//            $isArchiveExSM = explode(':', $request->ImageExSMPath); // BG image upload, crop and archive
//            if ($isArchiveExSM[0] == "http") {
//                //archives --- cut imgAll/ and get all after
//                $finalImageExSMPath = substr($request->ImageExSMPath, strpos($request->ImageExSMPath, 'images') + 7);
//
//            }// end of SM image upload, crop and archive section
//            //return $finalImageExSMPath;
//            $content->img_xs_path = $finalImageExSMPath;
//        }

        $content->content_type = $request->contentType;

        // If Lead News No and Want to Make Yes
        if ($request->leadNews == 1){
            $content_ids = BnContentPosition::select('content_ids')->first();
            $content_ids_check = explode(',', $content_ids->content_ids);

            if (!in_array($id, $content_ids_check)){
                $content_ids = $id.','.$content_ids->content_ids;
                $content_ids_array = explode(',', $content_ids);
                $new_content_ids = array_slice($content_ids_array, 0, 6);
                BnContentPosition::where('position_id', 1)->update(['content_ids' => implode(',',$new_content_ids)]);
            }
        }

        // If Lead News Yes and Want to Make No
        if ($request->leadNews == 0){
            $content_ids = BnContentPosition::select('content_ids')->first();
            $content_ids_check = explode(',', $content_ids->content_ids);

            if (in_array($id, $content_ids_check)){
                $content_ids = $content_ids->content_ids;
                $content_ids_array = explode(',', $content_ids);
                $key = array_search($id, $content_ids_array);
                unset($content_ids_array[$key]);
                BnContentPosition::where('position_id', 1)->update(['content_ids' => implode(',',$content_ids_array)]);
            }
        }

        $content->cat_id = $request->category;
        $content->subcat_id = $request->subCategory;
        $content->special_cat_id = $request->specialCategory;
        $content->country_id = $request->country;
        $content->district_id = $request->district;
        if ($request->district){
            $content->division_id   = District::find($request->district)->division_id;
        }
        $content->upozilla_id = $request->upozilla;
        $content->uploader_id = $request->uploader;
        $content->updated_by = auth()->user()->id;
        if ($request->prevNewsIds) $content->related_ids = implode(',', $request->prevNewsIds);
        if ($request->photoGalaryIds) $content->photo_ids = implode(',', $request->photoGalaryIds);
        $content->video_type = $request->videoType;
        $content->video_id = $request->videoId;

        $content->tags = $request->normalTags;
        $content->scroll = $request->scroll;

        $content->save();
        //new GenerateHTMLController($request->category, $request->specialCategory, $request->subCategory);

        return redirect('backend/bn-contents')->with('successMsg', 'The content has been updated successfully!');

    }

    public function destroy($id)
    {
        if (is_numeric($id)) {
            BnContent::where('content_id', $id)->update(['deletable' => 2]);
            return redirect('backend/bn-contents')->with('successMsg', 'The content has been removed successfully!');
        }
    }

    public function deletedList()
    {
        $contents = BnContent::with('category', 'specialCategory', 'subCategory')->where('deletable', 2)->orderBy('content_id', 'desc')->get();

        return view('backend.bn.content.deleted_content_list', compact('contents'));
    }

    public function enableContent($id)
    {
        if ($id) {
            BnContent::where('content_id', $id)->update(['deletable' => 1]);
            return redirect('backend/deleted-bn-contents')->with('successMsg', 'The content has been enabled!');
        }
    }

    public function getQuickUpdateContent(Request $request)
    {
        $id = $request->id;
        $content = BnContent::find($id);
        return \Response::json($content);
    }

    public function postQuickUpdate(Request $request)
    {
        $content = BnContent::find($request->contentId);
        $content->cat_id = $request->category;
        $content->subcat_id = $request->subCategory;
        $content->special_cat_id = $request->specialCategory;
        $content->district_id = $request->district;
        if ($request->district){
            $content->division_id   = District::find($request->district)->division_id;
        }
        $content->status = $request->showNews;
        $content->scroll = $request->scroll;
        $content->save();

        return redirect('backend/bn-contents')->with('successMsg', 'The content has been quick-updated successfully!');
    }

    private function setNewsPosition($type, $catId, $position, $contentId)
    {
        $news_position = '';
        if ($type == 'cat') {
            $news_position = BnContentPosition::where('cat_id', $catId)->first();
        } elseif ($type == 'special_cat') {
            $news_position = BnContentPosition::where('special_cat_id', $catId)->first();
        } elseif ($type == 'subcat') {
            $news_position = BnContentPosition::where('subcat_id', $catId)->first();
        }

        //return $news_position_ids;
        if (!empty($news_position)) {
            $news_position_ids = $news_position->content_ids;
            $aNews_position_ids = explode(',', $news_position_ids);
            $new_position = [$position - 1 => $contentId];
            array_splice($aNews_position_ids, $position - 1, 1, $new_position);
            $sNews_position_ids = implode(',', $aNews_position_ids);
            if ($type == 'cat') {
                BnContentPosition::where('cat_id', $catId)->update(['content_ids' => $sNews_position_ids]);
            } elseif ('special_cat') {
                BnContentPosition::where('special_cat_id', $catId)->update(['content_ids' => $sNews_position_ids]);
            } elseif ('subcat') {
                BnContentPosition::where('subcat_id', $catId)->update(['content_ids' => $sNews_position_ids]);
            }

            return true;
        }
    }
}
