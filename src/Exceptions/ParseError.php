<?php namespace Webcastle\Currency\Exceptions;

use Exception;

class ParseError extends Exception {

    public function __construct()
    {
        parent::__construct("Unknown google result");
    }
}
