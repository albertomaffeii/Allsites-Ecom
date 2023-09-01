<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('appSetting', function () {
            return new Setting();
        });
    }

    public function boot()
    {
        Paginator::useBootstrap();

        $websiteSetting = Setting::first();
        View::share('appSetting', $websiteSetting);
    }
}
