<?php

namespace App\Providers;

use App\BnSiteSettings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $bnSiteSettings = BnSiteSettings::first();
        Cache::forever('bnSiteSettings', $bnSiteSettings);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
