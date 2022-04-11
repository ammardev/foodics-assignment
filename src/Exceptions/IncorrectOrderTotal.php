<?php

namespace Foodics\Exceptions;

use Exception;

class IncorrectOrderTotal extends Exception
{
    public function __construct($actualTotal, $expectedTotal)
    {
        parent::__construct('Incorrect total error: actual('.$actualTotal.') != expected('.$expectedTotal.')');
    }
}