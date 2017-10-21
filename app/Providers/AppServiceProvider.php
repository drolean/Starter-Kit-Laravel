<?php

namespace App\Providers;

use Carbon\Carbon;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        \URL::forceScheme('https');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Seta Language do site para o configurado no app.php
        Carbon::setLocale(config('app.locale'));

        // Registra Helpers
        foreach (glob(app_path().'/Helpers/*.php') as $filename) {
            require_once $filename;
        }

        // [Local, Testing, Staging]
        if ($this->app->environment('local', 'testing', 'staging')) {
            $this->app->register(DuskServiceProvider::class);
        }

        // Em Produção
        if ($this->app->environment('production')) {
            $this->app->alias('bugsnag.multi', \Illuminate\Contracts\Logging\Log::class);
            $this->app->alias('bugsnag.multi', \Psr\Log\LoggerInterface::class);
        }
    }
}
