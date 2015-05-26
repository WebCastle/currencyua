<?php namespace Webcastle\Currency;

use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public function boot()
    {
		/*
        $this->publishes([
            __DIR__.'/../config/currency.php' => config_path('currency.php'),
        ]);
        * */
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
		/*9
        $this->mergeConfigFrom(
            __DIR__.'/../config/currency.php', 'currency'
        );
        * */
    }
}
