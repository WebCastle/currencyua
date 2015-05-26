<?php
use Webcastle\Currency\Currency;

function usd_to($currency, $value){
    return Currency::usdTo($currency, $value);
}

function from_usd($value){
    return usd_to( Currency::getCurrentCurrency(), $value );
}
