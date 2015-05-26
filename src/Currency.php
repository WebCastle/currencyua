<?php namespace Webcastle\Currency;

use Illuminate\Support\Facades\Cache;

class Currency{

    private $currencies;

	public static function fromUsd($value){
		echo 1;
	}

    public static function usdTo($currency, $value){
        $rate = Cache::get( 'currency_'.$currency, self::getCurrency());
        return $rate * $value;
    }

    public function getCurrency(){
        return 11;
    }
	
}
