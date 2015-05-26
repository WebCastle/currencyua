<?php namespace Webcastle\Currency;

use Illuminate\Support\Facades\Cache;

class Currency{

    private $currencies;

    public static function fromUsd($value){
        echo 1;
    }

    public static function usdTo($currency, $value){
        $rate  = Cache::remember('currency-usd'.'-'.$currency, 100, function() use($currency){
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
        $data = explode($to_Currency, $data[1]);

        return round($data[0], 2);
    }

}
