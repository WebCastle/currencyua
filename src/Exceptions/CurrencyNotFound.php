<?php namespace Webcastle\Currency\Exceptions;

use Exception;

class CurrencyNotFound extends Exception {

    public function __construct()
    {
        parent::__construct("Unknown currency code");
    }
}
