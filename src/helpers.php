<?php
    use Webcastle\Currency\Currency;

    function usd_to($currency, $value){
        return Currency::usdTo($currency, $value);
    }
