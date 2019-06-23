<?php

namespace App\Http\Controllers;

use App\BnAuthor;
use Illuminate\Http\Request;

class BnAuthorController extends Controller
{
    public function __construct(){
        $this->sMonthlyImageFolder=MonthlyFolderController::getLastMonthlyFolder().'/';
    }

    public function index()
    {
        $authors = BnAuthor::where('deletable', 1)->get();

        return view('backend.settings.bn_author_list', compact('authors'));
    }

    public function create()
    {
        return view('backend.settings.bn_author_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'author_name'       => 'required',
            'author_name_bn'    => 'required',
            'author_slug'       => 'required|unique:mysql.authors',
            'author_initial'    => 'required|unique:mysql.authors',
            'author_initial_bn' => 'required',
            'author_image'      => 'mimes:jpg,jpeg,png|max:100'
        ]);

        $author = new BnAuthor();
        $author->author_type        = $request->author_type;
        $author->author_name        = $request->author_name;
        $author->author_name_bn     = $request->author_name_bn;
        $author->author_slug        = fFormatUrl($request->author_slug);
        $author->author_initial     = $request->author_initial;
        $author->author_initial_bn  = $request->author_initial_bn;
        $author->author_bio         = $request->author_bio;
        $author->author_bio_bn      = $request->author_bio_bn;

        if($request->hasFile('author_image')){
            $ext = $request->file('author_image')->getClientOriginalExtension();
            $filename = $author->author_slug . '-' . date("YmdHis") .'.'. $ext;
            $request->file('author_image')->move(config('appconfig.authorImagePath'), $filename);
            $author->img_path = $filename;
        }

        $author->save();

        return redirect('backend/bn-authors')->with('successMsg', 'The author has been inserted successfully!');
    }

    public function edit($id)
    {
        $author = BnAuthor::find($id);

        return view('backend.settings.bn_author_edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'author_name'       => 'required',
            'author_slug'       => 'required|unique:mysql.authors,author_slug,'.$id.',author_id',
            'author_name_bn'    => 'required',
            'author_initial'    => 'required|unique:mysql.authors,author_initial,'.$id.',author_id',
            'author_initial_bn' => 'required|unique:mysql.authors,author_initial_bn,'.$id.',author_id',
            'author_image'      => 'mimes:jpg,jpeg,png|max:100'
        ]);

        $author = BnAuthor::find($id);
        $author->author_type        = $request->author_type;
        $author->author_name        = $request->author_name;
        $author->author_name_bn     = $request->author_name_bn;
        $author->author_slug        = fFormatUrl($request->author_slug);
        $author->author_initial     = $request->author_initial;
        $author->author_initial_bn  = $request->author_initial_bn;
        $author->author_bio         = $request->author_bio;
        $author->author_bio_bn      = $request->author_bio_bn;

        if($request->hasFile('author_image')){
            FileController::deleteFile(config('appconfig.authorImagePath'), $author->img_path);
            $ext = $request->file('author_image')->getClientOriginalExtension();
            $filename = $author->author_slug . '-' . date("YmdHis") .'.'. $ext;
            $request->file('author_image')->move(config('appconfig.authorImagePath'), $filename);
            $author->img_path = $filename;
        }

        $author->save();

        return redirect('backend/bn-authors')->with('successMsg', 'The author has been updated successfully!');
    }

    public function destroy($id)
    {
        BnAuthor::where('author_id', $id)->update(['deletable' => 2]);

        return redirect('backend/bn-authors')->with('successMsg', 'The author has been removed successfully!');
    }
}
