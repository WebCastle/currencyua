<?php namespace Webcastle\Currency;

use Illuminate\Support\ServiceProvider;
use Session;

class CurrencyServiceProvider extends ServiceProvider
{
    public function boot()
    {
		
        $this->publishes([
            __DIR__.'/config/currency.php' => config_path('currency.php'),
        ]);
        
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
		
        $this->mergeConfigFrom(
            __DIR__.'/config/currency.php', 'currency'
        );


        $defaultCurrency = Session::get('currency');
        if ($defaultCurrency == null){
            Session::set('currency', config("currency.default_currency"));
        }

    }
}
