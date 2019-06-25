<?php

function bnHeaderCategory(){
    return \App\BnCategory::where('cat_type', 1)->where('status', 1)->where('deletable', 1)->get();
}

function bnFooterCategory(){
    return \App\BnCategory::where('cat_type', 1)->where('footer_menu', 1)->where('status', 1)->where('deletable', 1)->orderBy('cat_position')->get();
}

function enHeaderCategory(){
    return \App\EnCategory::where('cat_type', 1)->where('status', 1)->where('deletable', 1)->get();
}

function enFooterCategory(){
    return \App\EnCategory::where('cat_type', 1)->where('footer_menu', 1)->where('status', 1)->where('deletable', 1)->orderBy('cat_position')->get();
}

function fFormatUrl($content){
    $arrChars= [":", "‘", "’", "/", "'", "`", "?", "&", "%", "_", "(", ")", '"', "!", "-", ",", " "];
    $content = strip_tags(stripslashes(trim($content)));
    $rContent = strtolower(str_replace($arrChars, '-', $content));
    $rContent = str_replace('--', '-', $rContent);
    $rContent = str_replace('--', '-', $rContent);
    $rContent = html_entity_decode(trim($rContent, '-'));
    return $rContent;
}

function fDesktopURL($ContentID, $CatSlug=null,$SubCatSlug=null,$ContentType=1){
    $sURL=url(($CatSlug!=null? $CatSlug : "national")."/".($SubCatSlug!=null? $SubCatSlug : ($ContentType==2? "article" : "news"))."/".$ContentID);
    return $sURL;
}

function fEnURL($ContentID, $CatSlug=null,$SubCatSlug=null,$ContentType=1){
    $sURL=url('/en/'.($CatSlug!=null? $CatSlug : "national")."/".($SubCatSlug!=null? $SubCatSlug : ($ContentType==2? "article" : "news"))."/".$ContentID);
    return $sURL;
}

function fAlbumURL($albumID, $catSlug, $subCatSlug=null){
    $sURL = url('/photo/'.$catSlug."/".($subCatSlug != null? $subCatSlug."/" : '').$albumID);
    return $sURL;
}

function fVideoURL($videoID, $catSlug, $subCatSlug=null){
    $sURL = url('/video/'.$catSlug."/".($subCatSlug != null? $subCatSlug."/" : '').$videoID);
    return $sURL;
}

function fFormatImgBase64ToJPEG($base64_string, $output_file)
{
    $file = explode('.', $output_file);
    $output_file=date('YF').'/'.$file[0].'-'.date("YmdHis").'.'.$file[1];
    $file = config('appconfig.contentImagePath').$output_file;
    $data = explode(',', $base64_string);
    File::put($file, base64_decode($data[1]));
    return $output_file;
}

function fFormatDateEn2Bn($BDDate){
    //Convert a English date to Bangla date
    $en=array("AM","PM","am","pm","Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","January","February","March","April","May","June","July","August","September","October","November","December","0","1","2","3","4","5","6","7","8","9");
    $bn=array("এএম","পিএম","এএম","পিএম","শনিবার","রোববার","সোমবার","মঙ্গলবার","বুধবার","বৃহস্পতিবার","শুক্রবার","জানুয়ারি","ফেব্রুয়ারি","মার্চ","এপ্রিল","মে","জুন","জুলাই","আগস্ট","সেপ্টেম্বর","অক্টোবর","নভেম্বর","ডিসেম্বর","০","১","২","৩","৪","৫","৬","৭","৮","৯");
    $BDDate=str_replace($en,$bn,$BDDate);
    return $BDDate;
}

function fGetWord($string, $length){
    $aText = explode(' ', $string);
    $aCount = count($aText);
    $rText = implode(' ', array_slice($aText, 0, $length));
    $rText .= $aCount > $length ? '...' : '';
    return $rText;
}


function getBnHeaderMenuContent(){
    // Header Menu Contents
    $headerMenuPosition = App\BnContentPosition::where('special_cat_id', 31)->where('deletable', 1)->first();
    if(!is_null($headerMenuPosition->content_ids)){
        $aContentIDs = explode(",", $headerMenuPosition->content_ids);
        $aContentIDs = array_slice($aContentIDs, 0, 1);
        $sContentIDs = implode(',', $aContentIDs);
        $headerMenuContents = App\BnContent::with('category', 'subcategory')->where('content_id', $sContentIDs)->where('status', 1)->where('deletable', 1)->first();
//            dd($headerMenuContents);

        return $headerMenuContents;
    }
}

function getEnHeaderMenuContent(){
    // Header Menu Contents
    $headerMenuPosition = App\EnContentPosition::where('special_cat_id', 31)->where('deletable', 1)->first();
    if(!is_null($headerMenuPosition->content_ids)){
        $aContentIDs = explode(",", $headerMenuPosition->content_ids);
        $aContentIDs = array_slice($aContentIDs, 0, 1);
        $sContentIDs = implode(',', $aContentIDs);
        $headerMenuContents = App\EnContent::with('category', 'subcategory')->where('content_id', $sContentIDs)->where('status', 1)->where('deletable', 1)->first();
//            dd($headerMenuContents);

        return $headerMenuContents;
    }
}

function fFormatString($string){
    //Ommits HTML Code from the texts
    $string=strip_tags($string);//Strip HTML and PHP tags from a string
    $string=str_replace("'", "`", $string);
    return $string;
}

function fFormatDateAsMySQL($sDate){
    //Converts a date to MySQL data value YYYY-MM-DD
    //Workable for DatePicker or jQuery UI DatePicker
    $sDate=str_replace('/', '-', $sDate);
    $sDate=date("Y-m-d", strtotime($sDate));
    return $sDate;
}