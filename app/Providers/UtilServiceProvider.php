<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UtilServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind Util class so we can just write 'use Util' at the start of controller namespace
        // This is related to 'providers' in app.php
        $this->app->bind(
            'util',
            'App\Libs\Util'
        );
    }

}
