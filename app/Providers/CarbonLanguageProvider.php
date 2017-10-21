<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class CarbonLanguageProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        Carbon::setLocale($this->app->getLocale());
    }
}
