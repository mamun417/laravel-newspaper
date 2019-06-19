<?php

namespace App\Http\Controllers;

use App\EnAuthor;
use Illuminate\Http\Request;

class EnAuthorController extends Controller
{
    public function __construct(){
        $this->sMonthlyImageFolder=MonthlyFolderController::getLastMonthlyFolder().'/';
    }

    public function index()
    {
        $authors = EnAuthor::where('deletable', 1)->get();

        return view('backend.settings.en_author_list', compact('authors'));
    }

    public function create()
    {
        return view('backend.settings.en_author_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'author_name'       => 'required',
            'author_slug'       => 'required|unique:mysqlen.authors',
            'author_initial'    => 'required|unique:mysqlen.authors',
            'author_image'      => 'mimes:jpg,jpeg,png|max:100'
        ]);

        $author = new EnAuthor();
        $author->author_type        = $request->author_type;
        $author->author_name        = $request->author_name;
        $author->author_slug        = fFormatUrl($request->author_slug);
        $author->author_initial     = $request->author_initial;
        $author->author_bio         = $request->author_bio;

        if($request->hasFile('author_image')){
            $ext = $request->file('author_image')->getClientOriginalExtension();
            $filename = $author->author_slug . '-' . date("YmdHis") .'.'. $ext;
            $request->file('author_image')->move(config('appconfig.authorImagePath'), $filename);
            $author->img_path = $filename;
        }

        $author->save();

        return redirect('backend/en-authors')->with('successMsg', 'The author has been inserted successfully!');
    }

    public function edit($id)
    {
        $author = EnAuthor::find($id);

        return view('backend.settings.en_author_edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'author_name'       => 'required',
            'author_slug'       => 'required',
            'author_initial'    => 'required',
            'author_image'      => 'mimes:jpg,jpeg,png|max:100'
        ]);

        $author = EnAuthor::find($id);
        $author->author_type        = $request->author_type;
        $author->author_name        = $request->author_name;
        $author->author_slug        = fFormatUrl($request->author_slug);
        $author->author_initial     = $request->author_initial;
        $author->author_bio         = $request->author_bio;

        if($request->hasFile('author_image')){
            FileController::deleteFile(config('appconfig.authorImagePath'), $author->img_path);
            $ext = $request->file('author_image')->getClientOriginalExtension();
            $filename = $author->author_slug . '-' . date("YmdHis") .'.'. $ext;
            $request->file('author_image')->move(config('appconfig.authorImagePath'), $filename);
            $author->img_path = $filename;
        }

        $author->save();

        return redirect('backend/en-authors')->with('successMsg', 'The author has been updated successfully!');
    }

    public function destroy($id)
    {
        EnAuthor::where('author_id', $id)->update(['deletable' => 2]);

        return redirect('backend/en-authors')->with('successMsg', 'The author has been removed successfully!');
    }
}
