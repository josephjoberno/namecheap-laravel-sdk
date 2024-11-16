<?php

namespace Namecheap\Laravel;

use Namecheap\Laravel\NamecheapClient;
use Illuminate\Support\ServiceProvider;

class NamecheapServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/namecheap.php' => config_path('namecheap.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/namecheap.php', 'namecheap');

        $this->app->singleton('namecheap', function ($app) {
            return new NamecheapClient(
                config('namecheap.api_key'),
                config('namecheap.username'),
                config('namecheap.api_user'),
                config('namecheap.client_ip'),
                config('namecheap.sandbox')
            );
        });
    }
}