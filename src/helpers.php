<?php
use Webcastle\Currency\Currency;

function usd_to($currency, $value){
    return Currency::usdTo($currency, $value);
}

function from_usd($value){
    return usd_to( Currency::getCurrentCurrency(), $value );
}

function currency($currency = null){
	if($currency != null ){
		Currency::setCurrentCurrency($currency);
	}else{
		Currency::getCurrentCurrency($currency);
	}
};
