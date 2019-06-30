<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/clear-dp', function () {
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    return 'true';
});


Route::get('/info', function () {
    echo phpinfo();
});

//Auth::routes();

Route::get('usa-admin', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('usa-admin', 'Auth\LoginController@login')->name('admin.login.submit');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/backend/dashboard', 'BnDashboardController@index')->name('admin.dashboard');

    Route::get('backend/quickupdate-content', 'BnContentController@getQuickUpdateContent');
    Route::post('backend/quickupdate-content', 'BnContentController@postQuickUpdate');
    Route::get('backend/enable-bn-content/{id}', 'BnContentController@enableContent');
    Route::get('backend/deleted-bn-contents', 'BnContentController@deletedList');
    Route::get('backend/populate-category', 'BnContentController@populateCat');
    Route::resource('backend/bn-contents', 'BnContentController');

    Route::get('backend/bn-populate-position', 'BnContentPositionController@populatePosition');
    Route::get('backend/bn-content-position/keyword', 'BnContentPositionController@autocompleteBnContentSearch');
    Route::get('backend/bn-content-position/change/{id}', 'BnContentPositionController@getChangePosition');
    // Route::post('backend/bn-content-position/change', 'BnContentPositionController@postBnSetPosition');
    Route::post('backend/bn-position/change', 'BnContentPositionController@changePosition'); // news position sortable save route
    Route::resource('backend/bn-content-position', 'BnContentPositionController');
    Route::get('backend/bn-comments/change-approval/{commentId}', 'BnCommentController@changeApproval')->where('commentId', '[0-9]+');
    Route::get('backend/bn-comment-reply', 'BnCommentController@commentReply');
    Route::delete('backend/bn-comment-reply/{id}', 'BnCommentController@destroyCmtReply');
    Route::get('backend/bn-comment-reply/change-approval/{replyId}', 'BnCommentController@changeApprovalCmtReply')->where('replyId', '[0-9]+');
    Route::resource('backend/bn-comments', 'BnCommentController');
    Route::get('backend/bn-reader-contents/change-approval/{contentId}', 'BnReaderContentController@changeApproval');
    Route::resource('backend/bn-reader-contents', 'BnReaderContentController');

    Route::resource('/backend/countries', 'CountryController');
    Route::resource('/backend/divisions', 'DivisionController');
    Route::resource('/backend/districts', 'DistrictController');
    Route::get('backend/upozilla-populate', 'UpozillaController@upozillaPopulate');
    Route::resource('backend/upozillas', 'UpozillaController');
    Route::resource('/backend/monthly-folders', 'MonthlyFolderController');

    Route::resource('/backend/bn-tags', 'BnTagController');
    Route::resource('/backend/bn-categories', 'BnCategoryController');
    Route::get('backend/subcat-populate', 'BnSubcategoryController@subcatPopulate');
    Route::resource('/backend/bn-subcategories', 'BnSubcategoryController');

    Route::get('backend/admin/{id}/change-password', 'AdminController@getChangePassword');
    Route::put('backend/admin/{id}/change-password', 'AdminController@postChangePassword');
    Route::resource('backend/admins', 'AdminController');
    Route::get('backend/user/{id}/change-password', 'UserController@getChangePassword');
    Route::put('backend/user/{id}/change-password', 'UserController@postChangePassword');
    Route::resource('backend/users', 'UserController');
    Route::resource('backend/bn-site-settings', 'BnSiteSettingsController');
    Route::resource('backend/bn-authors', 'BnAuthorController');
    Route::resource('backend/mis-users', 'MisUserController');
    Route::resource('backend/manual-docs', 'ManualDocController');
    Route::post('backend/attach-photo-upload', 'ManualPhotoController@attachPhotoUpload');
    Route::resource('backend/manual-photos', 'ManualPhotoController');
    Route::get('backend/normaltag-search', 'SearchController@searchNormalTag');

    // En Routes
    Route::resource('/backend/en-tags', 'EnTagController');
    Route::resource('backend/en-site-settings', 'EnSiteSettingsController');
    Route::resource('/backend/en-categories', 'EnCategoryController');
    Route::get('backend/en-subcat-populate', 'EnSubcategoryController@subcatPopulate');
    Route::resource('/backend/en-subcategories', 'EnSubcategoryController');
    Route::resource('backend/en-authors', 'EnAuthorController');
    Route::get('backend/en-normaltag-search', 'SearchController@searchEnNormalTag');
    Route::get('backend/en-populate-category', 'EnContentController@populateCat');
    Route::get('backend/en-quickupdate-content', 'EnContentController@getQuickUpdateContent');
    Route::post('backend/en-quickupdate-content', 'EnContentController@postQuickUpdate');
    Route::resource('backend/en-contents', 'EnContentController');

    Route::get('backend/en-populate-position', 'EnContentPositionController@populatePosition');
    Route::get('backend/en-content-position/keyword', 'EnContentPositionController@autocompleteEnContentSearch');
    Route::get('backend/en-content-position/change/{id}', 'EnContentPositionController@getChangePosition');
    // Route::post('backend/en-content-position/change', 'BnContentPositionController@postEnSetPosition');
    Route::post('backend/en-position/change', 'EnContentPositionController@changePosition'); // news position sortable save route
    Route::resource('backend/en-content-position', 'EnContentPositionController');

    Route::get('backend/en-comments/change-approval/{commentId}', 'EnCommentController@changeApproval')->where('commentId', '[0-9]+');
    Route::get('backend/en-comment-reply', 'EnCommentController@commentReply');
    Route::delete('backend/en-comment-reply/{id}', 'EnCommentController@destroyCmtReply');
    Route::get('backend/en-comment-reply/change-approval/{replyId}', 'EnCommentController@changeApprovalCmtReply')->where('replyId', '[0-9]+');
    Route::resource('backend/en-comments', 'EnCommentController');

    // Photo Routes
    Route::resource('backend/photo-categories', 'PhotoCategoryController');
    Route::get('backend/photo-subcat-populate', 'PhotoSubcategoryController@subcatPopulate');
    Route::resource('backend/photo-subcategories', 'PhotoSubcategoryController');
    Route::resource('backend/photo-albums', 'PhotoAlbumController');
    Route::resource('backend/photo-gallery', 'PhotoGalleryController');

    Route::get('backend/photo-comments/change-approval/{commentId}', 'PhotoCommentController@changeApproval')->where('commentId', '[0-9]+');
    Route::get('backend/photo-comment-reply', 'PhotoCommentController@commentReply');
    Route::delete('backend/photo-comment-reply/{id}', 'PhotoCommentController@destroyCmtReply');
    Route::get('backend/photo-comment-reply/change-approval/{replyId}', 'PhotoCommentController@changeApprovalCmtReply')->where('replyId', '[0-9]+');
    Route::resource('backend/photo-comments', 'PhotoCommentController');

    // Video Routes
    Route::resource('backend/video-categories', 'VideoCategoryController');
    Route::get('backend/video-subcat-populate', 'VideoSubcategoryController@subcatPopulate');
    Route::resource('backend/video-subcategories', 'VideoSubcategoryController');
    Route::resource('backend/videos', 'VideoController');
    // Video Comment Routes
    Route::get('backend/video-comments/change-approval/{commentId}', 'VideoCommentController@changeApproval')->where('commentId', '[0-9]+');
    Route::get('backend/video-comment-reply', 'VideoCommentController@commentReply');
    Route::delete('backend/video-comment-reply/{id}', 'VideoCommentController@destroyCmtReply');
    Route::get('backend/video-comment-reply/change-approval/{replyId}', 'VideoCommentController@changeApprovalCmtReply')->where('replyId', '[0-9]+');
    Route::resource('backend/video-comments', 'VideoCommentController');


    // Survey Routes
    Route::get('backend/bn-survey/change-status/{id}/{status}', 'BnSurveyController@changeStatus')->name('bn.survey.edit');
    Route::resource('backend/bn-survey', 'BnSurveyController');
    Route::get('backend/en-survey/change-status/{id}/{status}', 'EnSurveyController@changeStatus')->name('en.survey.edit');
    Route::resource('backend/en-survey', 'EnSurveyController');

    // Ads Management Routes
    Route::get('backend/ads/top', 'AdsManagementController@topAds')->name('top_ad');
    Route::get('backend/ads/footer', 'AdsManagementController@footerAds')->name('footer_ad');
    Route::get('backend/ads/after-lead-news', 'AdsManagementController@afterLeadNews')->name('after_lead_news');
    Route::get('backend/ads/before-sports-news', 'AdsManagementController@beforeSportsNews')->name('before_sports_news');
    Route::get('backend/ads/category-right-top', 'AdsManagementController@categoryRightTop')->name('category_right_top');
    Route::get('backend/ads/category-right-bottom', 'AdsManagementController@categoryRightBottom')->name('category_right_bottom');
    Route::get('backend/ads/news-details-right-top', 'AdsManagementController@newsDetailsRightTop')->name('news_details_right_top');
    Route::get('backend/ads/news-details-right-bottom', 'AdsManagementController@newsDetailsRightBottom')->name('news_details_right_bottom');

    Route::post('backend/ads/store/{position}', 'AdsManagementController@store')->name('ads.store');
    Route::get('backend/ads/{position}/edit', 'AdsManagementController@edit')->name('ads.edit');
    Route::post('backend/ads/{position}', 'AdsManagementController@update')->name('ads.update');
    Route::delete('backend/ads/{position}', 'AdsManagementController@destroy')->name('ads.destroy');
});

// En Frontend routes
Route::prefix('en')->group(function () {
    Route::get('/', 'EnFrontendController@index');
    Route::post('/subscribe', 'SubscriptionController@subscribe')->name('en.subscribe');
    Route::get('/div-dis-upz', function (){
        $sURL = request()->division ? 'bangladesh/'.request()->division . (request()->district ? '/' . request()->district . (request()->upozilla ? '/' . request()->upozilla : '') : '') : '';
        return redirect($sURL);
    });
    Route::post('/en-vote/{id}', 'EnFrontendController@surveyVote')->name('en.vote')->where('id', '[0-9]+');
    Route::get('/old-survey-result', 'EnFrontendController@oldSurveyResult');
    Route::get('/archive/{date?}', 'EnFrontendController@archive');
    Route::get('/{catSlug}', 'EnFrontendController@categoryContent');
    Route::get('/{catSlug}/{subcatSlug}', 'EnFrontendController@subcategoryContent');
    Route::get('/{catSlug}/{contentType}/{contentId}', 'EnFrontendController@details');
    Route::get('/bangladesh/{division}/{district?}/{upozilla?}', 'EnFrontendController@divisionDistrictUpozillaContent');
});

// Bn Frontend routes
Route::get('/div-dis-upz', function (){
   $sURL = request()->division ? 'bangladesh/'.request()->division . (request()->district ? '/' . request()->district . (request()->upozilla ? '/' . request()->upozilla : '') : '') : '';
    return redirect($sURL);
});


Route::post('/subscribe', 'SubscriptionController@subscribe')->name('bn.subscribe');
Route::post('/bn-vote/{id}', 'BnFrontendController@surveyVote')->name('bn.vote')->where('id', '[0-9]+');
Route::get('/old-survey-result', 'BnFrontendController@oldSurveyResult');


Route::get('/district-populate', 'BnHelperController@districtPopulate');
Route::get('/upozilla-populate', 'BnHelperController@upozillaPopulate');
Route::get('/archive/{date?}', 'BnFrontendController@archive');
Route::get('/news-sitemap.xml', 'BnFrontendController@generateSitemap');

Route::get('/', 'BnFrontendController@index');
Route::get('/{catSlug}', 'BnFrontendController@categoryContent');
Route::get('/{catSlug}/{subcatSlug}', 'BnFrontendController@subcategoryContent');

Route::get('/{catSlug}/{contentType}/{contentId}', 'BnFrontendController@details')->where('contentId', '[0-9]+');
Route::get('/bangladesh/{division}/{district?}/{upozilla?}', 'BnFrontendController@divisionDistrictUpozillaContent');

