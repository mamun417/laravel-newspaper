<?php

namespace App\Http\Controllers;

use App\EnTag;
use Illuminate\Http\Request;

class EnTagController extends Controller
{
    public function index()
    {
        $tags = EnTag::where('deletable', 1)->orderBy('tag_id', 'desc')->get();
        return view('backend.settings.en_tag_list', compact('tags'));
    }

    public function create()
    {
        return view('backend.settings.en_tag_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tagName' => 'required',
            'tagSlug' => 'required'
        ]);

        $tag = new EnTag();

        $tag->tag_type = $request->tagType;
        $tag->tag_name = $request->tagName;
        $tag->tag_slug = $request->tagSlug;
        $tag->description = $request->tagDescription;
        if($request->hasFile('tagPhoto')){
            $finalPhotoPath = FileController::fileUpload($request->tagPhoto, config('appconfig.tagImagePath'));
            $tag->img_path = $finalPhotoPath;
        }
        $tag->approval = $request->approval;
        $tag->save();
        return redirect('backend/en-tags')->with('successMsg', 'The English tag has been inserted successfully!');
    }

    public function edit($id)
    {
        $tag = EnTag::find($id);
        return view('backend.settings.en_tag_edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tagName' => 'required',
            'tagSlug' => 'required'
        ]);

        $tag = EnTag::find($id);

        $tag->tag_type = $request->tagType;
        $tag->tag_name = $request->tagName;
        $tag->tag_slug = $request->tagSlug;
        $tag->description = $request->tagDescription;
        if($request->hasFile('tagPhoto')){
            $finalPhotoPath = FileController::fileUpload($request->tagPhoto, config('appconfig.tagImagePath'));
            $tag->img_path = $finalPhotoPath;
        }
        $tag->approval = $request->approval;
        $tag->save();
        return redirect('backend/en-tags')->with('successMsg', 'The English tag has been updated successfully!');
    }

    public function destroy($id)
    {
        if (is_numeric($id)) {
            EnTag::where('tag_id', $id)->update(['deletable' => 2]);
            return redirect('backend/en-tags')->with('successMsg', 'The English tag has been removed successfully!');
        }
    }
}
