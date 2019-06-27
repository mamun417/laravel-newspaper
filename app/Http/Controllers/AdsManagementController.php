<?php

namespace App\Http\Controllers;

use App\AdsManagement;
use Illuminate\Http\Request;

class AdsManagementController extends Controller
{
    public function store(){

        //
    }

    public function topAd(){

        $top_ads = AdsManagement::where('position', 'top_ad')->get();

        return view('backend.add_management.top_add', compact('top_ads'));
    }

    public function footerAd(){

        //
    }

    public function afterLeadNews(){

        //
    }

    public function beforeSportsNews(){

        //
    }

    public function categoryRightTop(){

        //
    }

    public function categoryRightBottom(){

        //
    }

    public function newsDetailsRightTop(){

        //
    }

    public function newsDetailsRightBottom(){

        //
    }

}
