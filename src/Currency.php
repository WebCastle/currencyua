<?php namespace Webcastle\Currency;

use Illuminate\Support\Facades\Cache;
use Webcastle\Currency\Exceptions\ParseError;
use Webcastle\Currency\Exceptions\CurrencyNotFound;
use Session;

class Currency{
	
	private static $codes;

    public static function usdTo($currency, $value){
		self::validate($currency);
        if ($currency == 'USD')
            return $value;
        $rate  = Cache::remember('currency-usd'.'-'.$currency, config('currency.lifetime'), function() use($currency){
            return self::getCurrency('USD', $currency);
        });
        return $rate * $value;
    }

    public static function getCurrency($from_Currency, $to_Currency){
		
        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);

        $url = "http://www.google.com/finance/converter?a=1&from=$from_Currency&to=$to_Currency";

        $ch = curl_init();
        $timeout = 0;
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt ($ch, CURLOPT_USERAGENT,
            "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $rawdata = curl_exec($ch);
        curl_close($ch);
        $data = explode('bld>', $rawdata);

        if ( !isset($data[1]) || !isset($data[0])  ){
            throw new ParseError();
        }
        $data = explode($to_Currency, $data[1]);

        return round($data[0], 2);
    }

    public static function getCurrentCurrency(){
        return Session::get('currency');
    }

    public static function setCurrentCurrency($currency){
        Session::put('currency', $currency);
        static::getCurrentCurrency();
    }

	public static function validate($currency){

        if (static::$codes == null){
			static::$codes = config('currency.currency_list');
		}

		if( !isset(static::$codes[$currency]) ){
			throw new CurrencyNotFound();
		}

	}
}
