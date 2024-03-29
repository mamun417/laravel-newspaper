<?php

namespace App\Http\Controllers;

use App\BnTag;
use App\EnTag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchNormalTag(Request $request){
        // submitted letters from TokenInput
        $letters = $request->q;
        $normal_tags = BnTag::where('tag_type', 1)->where('deletable',1)->where('approval', 1)->where('tag_name', 'LIKE', '%' . $letters . '%')->select('tag_slug as id', 'tag_name as name')->get();
        return $normal_tags->toArray();
    }

    public function searchEnNormalTag(Request $request){
        // submitted letters from TokenInput
        $letters = $request->q;
        $normal_tags = EnTag::where('tag_type', 1)->where('deletable',1)->where('approval', 1)->where('tag_name', 'LIKE', '%' . $letters . '%')->select('tag_slug as id', 'tag_name as name')->get();
        return $normal_tags->toArray();
    }
}
