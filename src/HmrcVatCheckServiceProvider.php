<?php

namespace PatrixshahUKVatChecker\HmrcVatCheck;

use Illuminate\Support\ServiceProvider;

class HmrcVatCheckServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load routes from the package
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        // Publish configuration file
        $this->publishes([
            __DIR__ . '/../config/hmrc_vat.php' => config_path('hmrc_vat.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge default configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../config/hmrc_vat.php',
            'hmrc_vat'
        );

        // Register the service class
        $this->app->singleton('HmrcVatService', function ($app) {
            return new \PatrixshahUKVatChecker\HmrcVatCheck\Services\HmrcVatService();
        });
    }
}
