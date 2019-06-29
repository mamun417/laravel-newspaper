<?php

namespace App\Http\Controllers;

use App\AdsManagement;
use Illuminate\Http\Request;

class AdsManagementController extends Controller
{
    public function store(Request $request, $position){
        $this->validate($request, [
            'ads_code'      => 'required',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
        ]);
        $request['position'] = $position;

        AdsManagement::create($request->all());
        return redirect(route($position));
    }

    public function update(Request $request, $position){
        $this->validate($request, [
            'ads_code'      => 'required',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
        ]);

        AdsManagement::where('position', $position)->first()->update($request->all());
        return redirect(route($position));
    }

    public function destroy($position){
        $ads = AdsManagement::where('position', $position)->first();
        $ads->delete();
        return redirect(route($position));
    }

    public function edit($position){
        $ads = AdsManagement::where('position', $position)->first();

        $ads_heading = '';
        switch ($position) {
            case 'top_ad':
                $ads_heading = 'Top Ads';
                break;
            case 'footer_ad':
                $ads_heading = 'Footer Ads';
                break;
            case 'after_lead_news':
                $ads_heading = 'After lead Ads';
                break;
            case 'before_sports_news':
                $ads_heading = 'Before Sports Ads';
                break;
            case 'category_right_top':
                $ads_heading = 'Category Right Top Ads';
                break;
            case 'category_right_bottom':
                $ads_heading = 'Category Right Bottom Ads';
                break;
            case 'news_details_right_top':
                $ads_heading = 'News Details Right Top Ads';
                break;
            case 'news_details_right_bottom':
                $ads_heading = 'News Details Right Bottom Ads';
                break;
        }

        return view('backend.add_management.ads_edit', compact('ads', 'ads_heading', 'position'));
    }

    public function topAds(){
        $ads = AdsManagement::where('position', 'top_ad')->get();
        $ads_heading = 'Top Ads';
        $ads_position = 'top_ad';
        return view('backend.add_management.ads_list', compact('ads', 'ads_heading', 'ads_position'));
    }

    public function footerAds(){
        $ads = AdsManagement::where('position', 'footer_ad')->get();
        $ads_heading = 'Footer Ads';
        $ads_position = 'footer_ad';
        return view('backend.add_management.ads_list', compact('ads', 'ads_heading', 'ads_position'));
    }

    public function afterLeadNews(){
        $ads = AdsManagement::where('position', 'after_lead_news')->get();
        $ads_heading = 'After Lead News Ads';
        $ads_position = 'after_lead_news';
        return view('backend.add_management.ads_list', compact('ads', 'ads_heading', 'ads_position'));
    }

    public function beforeSportsNews(){
        $ads = AdsManagement::where('position', 'before_sports_news')->get();
        $ads_heading = 'Before Sports News Ads';
        $ads_position = 'before_sports_news';
        return view('backend.add_management.ads_list', compact('ads', 'ads_heading', 'ads_position'));
    }

    public function categoryRightTop(){
        $ads = AdsManagement::where('position', 'category_right_top')->get();
        $ads_heading = 'Category Right Top Ads';
        $ads_position = 'category_right_top';
        return view('backend.add_management.ads_list', compact('ads', 'ads_heading', 'ads_position'));
    }

    public function categoryRightBottom(){
        $ads = AdsManagement::where('position', 'category_right_bottom')->get();
        $ads_heading = 'Category Right Bottom Ads';
        $ads_position = 'category_right_bottom';
        return view('backend.add_management.ads_list', compact('ads', 'ads_heading', 'ads_position'));
    }

    public function newsDetailsRightTop(){
        $ads = AdsManagement::where('position', 'news_details_right_top')->get();
        $ads_heading = 'News Details Right Top Ads';
        $ads_position = 'news_details_right_top';
        return view('backend.add_management.ads_list', compact('ads', 'ads_heading', 'ads_position'));
    }

    public function newsDetailsRightBottom(){
        $ads = AdsManagement::where('position', 'news_details_right_bottom')->get();
        $ads_heading = 'News Details Right Bottom Ads';
        $ads_position = 'news_details_right_bottom';
        return view('backend.add_management.ads_list', compact('ads', 'ads_heading', 'ads_position'));
    }
}
