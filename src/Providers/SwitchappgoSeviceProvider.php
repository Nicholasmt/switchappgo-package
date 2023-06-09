<?php

namespace Nicholasmt\Switchappgo\Providers;

use Illuminate\Support\ServiceProvider;

class SwitchappgoSeviceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->publishes([ __DIR__.'/../Controllers' => app_path('Http/nicholasmt/'),], 'library-controller');
        $this->publishes([ __DIR__.'/../php-jwt-master' => app_path('Http/nicholasmt/php-jwt-master/'),], 'jwt-master');

    }
}
