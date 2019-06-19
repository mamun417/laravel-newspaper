<?php

namespace App\Http\Controllers;

use App\BnAuthor;
use App\BnCategory;
use App\BnContent;
use App\User;
use Illuminate\Http\Request;

class BnDashboardController extends Controller
{
    public function index(){
        $totalContent = BnContent::where('deletable', 1)->where('status', 1)->count();
        $totalCategory = BnCategory::where('deletable', 1)->where('status', 1)->count();
        $totalAuthor = BnAuthor::where('deletable', 1)->count();
        $totalUser = User::where('deletable', 1)->where('visibility', 1)->count();

        return view('backend.dashboard', compact('totalContent', 'totalCategory', 'totalAuthor', 'totalUser'));
    }
}
