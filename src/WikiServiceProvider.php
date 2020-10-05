<?php

namespace AwemaPL\Wiki;

use Config;
use Illuminate\Support\ServiceProvider;

class WikiServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../dist' => public_path("assets/awema-pl/wiki"),
        ], 'awema-pl-public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Config::set('docs.path', realpath(__DIR__ . '/../docs'));
    }
}
