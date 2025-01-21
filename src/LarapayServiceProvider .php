<?php

namespace Larapay\Payu;

use Illuminate\Support\ServiceProvider;

class LarapayServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish the config file to the user's config directory
        $this->publishes([
            __DIR__.'/../../config/larapay.php' => config_path('larapay.php'),
        ], 'larapay-config');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    public function register()
    {
        // Register the PayU service
        $this->app->singleton('payu', function ($app) {
            return new PayuPayment(config('larapay'));
        });
    }
}
